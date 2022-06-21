<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\PointSetting;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLinkage;
use App\Models\User;
use App\Services\ImageServices;
use App\Services\TreeServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'admin daerah'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [2, 6, 7])->get();
            }elseif($user->getRoleNames()[0] == 'admin wilayah'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
            }
             else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
            }
            $authors[$k]['name'] = $v;
            if(count($row_author) > 0){
                foreach($row_author as $a=>$b){
                    $user_type = explode(',', $b->user_type);
                    if(in_array($k, $user_type)){
                        $authors[$k]['data'][$a]['id'] = $b->id;
                        $authors[$k]['data'][$a]['name'] = $b->name;
                        $authors[$k]['data'][$a]['type'] = $b->user_type;
                    }
                }
            }
        }



        if($user->getRoleNames()[0] == 'admin daerah'){
            return view('admin.posts.create-only', [
                'categories'=>$categories,
                'authors'=>$authors
            ]);
        }elseif($user->getRoleNames()[0] == 'admin wilayah'){
            return view('admin.posts.create-only', [
                'categories'=>$categories,
                'authors'=>$authors
            ]);
        }
        else{
            return view('admin.posts.create', [
                'categories'=>$categories,
                'authors'=>$authors
            ]);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'published_at'=>'required',
            'title'=>'required|max:255|unique:posts',
            'slug'=>'required|unique:posts',
            'category_id'=>'required',
            'preview'=>'required',
            'content'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/posts/'),
                'modul'=>'posts',
                'data'=>$data
            ];

            $image_service = ImageServices::Crop($image_data);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }

        $author = array_filter($request->author);

        try{
            $save = new Post();
            $save->code = Str::random(5);
            $save->title = $request->title;
            $save->slug = Str::slug($request->slug);
            $save->prefix = $request->prefix;
            $save->published_at = $request->published_at;
            $save->category_id = $request->category_id;
            $save->preview = $request->preview;
            $save->content = $request->content;
            $save->image = $image;
            $save->caption = $request->caption;
            $save->tags = $request->tags;
            $save->status = $request->status;
            $save->type = $request->type;
            $save->created_by = auth()->user()->id;
            $save->save();

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','post')
                        ->where('user_type', $k)
                        ->where('category_id', $request->category_id)
                        ->first();
                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = $request->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            $tags = htmlentities(str_replace(' ','',trim($request->tags)));
            $linkages = Post::where('status', 1)->where('id','<>',$save->id)->where('tags','RLIKE',$tags)->orderBy('published_at','desc')->take(6)->get();
            if(count($linkages) > 0){
                foreach($linkages as $k=>$v){
                    $save_linkage = new PostLinkage();
                    $save_linkage->parent_id = $save->id;
                    $save_linkage->child_id = $v->post_id;
                    $save_linkage->save();
                }
            }

            Cache::flush('posts');

            return redirect()->route('posts.index')->with('message', $save->title.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            return redirect()->route('posts.index')->with('message', $error->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'admin daerah'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [2, 6, 7])->get();
            }elseif($user->getRoleNames()[0] == 'admin wilayah'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
            }
             else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
            }
            $authors[$k]['name'] = $v;
            if($row_author){
                foreach($row_author as $a=>$b){
                    $user_type = explode(',', $b->user_type);
                    if(in_array($k, $user_type)){
                        $authors[$k]['data'][$a]['id'] = $b->id;
                        $authors[$k]['data'][$a]['name'] = $b->name;
                        $authors[$k]['data'][$a]['type'] = $b->user_type;
                    }
                }
                $user_point = Point::where('modul', 'post')->where('user_type', $k)->where('post_id', $id)->first();
                if($user_point){
                    $authors[$k]['id'] = $user_point->user_id;
                }else {
                    $authors[$k]['id'] = '';
                }
            }
        }

        if($user->getRoleNames()[0] == 'admin daerah'){
            return view('admin.posts.edit-only',[
                'data'          => Post::findOrFail($id),
                'categories'    => $categories,
                'authors'       => $authors
            ]);
        }elseif($user->getRoleNames()[0] == 'admin wilayah'){
            return view('admin.posts.edit-only',[
                'data'          => Post::findOrFail($id),
                'categories'    => $categories,
                'authors'       => $authors
            ]);
        }
        else{
            return view('admin.posts.edit',[
                'data'          => Post::findOrFail($id),
                'categories'    => $categories,
                'authors'       => $authors
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'published_at'=>'required',
            'title'=>[Rule::unique('posts')->ignore($id, 'id')],
            'slug'=>[Rule::unique('posts')->ignore($id, 'id')],
            'category_id'=>'required',
            'preview'=>'required',
            'content'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/posts/'),
                'modul'=>'posts',
                'data'=>$data
            ];

            $image_service = ImageServices::Crop($image_data);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }
        $author = array_filter($request->author);

        try{
            $save = Post::findOrFail($id);
            $save->title        = $request->title;
            $save->slug         = Str::slug($request->slug);
            $save->prefix       = $request->prefix;
            $save->published_at = $request->published_at;
            $save->category_id  = $request->category_id;
            $save->preview      = $request->preview;
            $save->content      = $request->content;
            $save->caption      = $request->caption;
            $save->tags         = $request->tags;
            $save->status       = $request->status;
            $save->type         = $request->type;
            $save->updated_by   = auth()->user()->id;
            if($image){
                $save->image    = $image;
            }
            $save->save();



            $points = Point::where('modul', 'post')->where('post_id', $id)->count();
            if($points > 0){
                Point::where('modul', 'post')->where('post_id', $id)->delete();
            }

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','post')
                        ->where('user_type', $k)
                        ->where('category_id', $request->category_id)
                        ->first();

                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = $request->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            Cache::flush("post-$data->code");
            return redirect()->route('posts.index')->with('message', $save->title.' | Berhasil diupdate!');
        }catch(Exception $error){
            return redirect()->route('posts.index')->with('message', $error->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}
