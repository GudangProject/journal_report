<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileLinkage;
use App\Models\FileCategory;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Office;
use App\Models\Officer;
use App\Models\Page;
use App\Models\User;
use App\Models\PageCategory;
use App\Models\PhotoContent;
use App\Models\Photos;
use App\Models\Point;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Service\Service;
use App\Models\Service\Service as ServiceService;
use App\Models\Service\ServiceDetail;
use App\Models\Service\ServiceRequest;
use App\Models\ServiceCategory;
use App\Models\Video;
use App\Models\VideoCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{

    public static function menu()
    {
        $data = Cache::rememberForever('menu', function(){
            $row = Menu::where('status', 1)->orderBy('order', 'ASC')->get();
            return $row;
        });
        return $data;
    }

    public static function headline()
    {
        $data = Cache::rememberForever('headline', function(){
            $row = Post::where('status', 1)->where('type', 2)->orderBy('published_at', 'DESC')->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function popular()
    {
        $data = Cache::remember('popular', 60 * 60 * 12, function(){
            $row = Post::where('status', 1)->where('published_at','>=', today()->subDays(30))->orderBy('counter', 'DESC')->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function post($code)
    {

        $data = Cache::rememberForever("post-$code", function() use($code){
            $row = Post::with('getLinkage')->where(DB::raw('BINARY `code`'), $code)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function posts($category = null, $page = null)
    {
        if($category != null){
            $category_id = PostCategory::where('slug', $category)->first()->id;
            $id = PostCategory::where('parent_id', $category_id)->pluck('id')->toArray();
            array_push($id, $category_id);

            $data = Cache::remember("posts-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
                if($category_id){
                    $row = Post::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->paginate(30);
                }else{
                    $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(30);
                }
                return $row;
            });

        }else{
            $data = Cache::remember("posts-$page", 60 * 60 * 12, function () {
                $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(30);
                return $row;
            });
        }
        return $data;
    }

    // public static function postOffice($slug = null)
    // {
    //     $category =
    // }

    public static function postsCategory($category = null, $page = null)
    {
        $category_id = PostCategory::where('slug', $category)->first()->id;
        $id = PostCategory::where('parent_id', $category_id)->pluck('id')->toArray();
        array_push($id, $category_id);

        $data = Cache::remember("postscategory-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
            if($category_id){
                $row = Post::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->paginate(30);
            }else{
                $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(30);
            }
            return $row;
        });

        return $data;
    }

    public static function postAuthor($slug = null, $page = null)
    {
        $author_id = User::where('slug', $slug)->first()->id;

        $data = Cache::remember("author-$slug-$page", 60 * 60 * 12, function () use($author_id) {
            $row = Point::join('posts', 'posts.id', '=', 'post_id')
                ->where('user_id', $author_id)
                ->where('modul', 'post')
                ->where('posts.status', 1)->with('getCategory', 'getPost')
                ->orderBy('posts.published_at', 'desc')->paginate(30)->withQueryString();
            return $row;
        });

        return $data;
    }

    public static function postOffice($slug = null)
    {
        $kota = ucwords(str_replace('-', ' ', $slug));
        try{
            $user = User::where('kota', 'LIKE', "%$kota%")->pluck('id')->toArray();

            // if($user){
                $row = Post::where('status', 1)
                        ->whereIn('created_by', $user)
                        ->orderBy('published_at', 'DESC')
                        ->paginate(12)->withQueryString();
                return $row;
            // }else{
            //     $row = Post::where('status', 1);
            //     $row = $row->orWhere(function($q) use($kota) {
            //         // dd($kota);
            //         $q->where('title', 'LIKE', "%$kota%");
            //     });
            //     $row = $row->orderBy('published_at', 'DESC')->paginate(30)->withQueryString();
            //     return $row;
            // }
        }catch(Exception $e){
            return back();
        }
    }

    public static function search($querry = null)
    {
        try {
            $terms = ucwords(str_replace('-', ' ', $querry));
            $data = Post::where('status', 1)->where('title', 'like', "%$terms%");
            $data = $data->orWhere(function($q) use($terms) {
                $q->where('content', 'LIKE', "%$terms%")
                ->where('tags', 'LIKE', "%$terms%");
            });

            $data = $data->orderBy('published_at', 'DESC')->paginate(30)->withQueryString();

            return $data;
        } catch (Exception $e) {
            return back();
        }
    }

    // public static function services($category)
    // {
    //     $category_id = ServiceCategory ::where('slug', $category)->first()->id;
    //     $data = Cache::rememberForever("services-$category_id", function() use($category_id){
    //         $row = Service::where('status', 1)->where('category_id', $category_id)->get();
    //         return $row;
    //     });
    //     return $data;
    // }

    public static function services()
    {

        $rows = Service::all();
        // dd($rows[1]->serviceDetail->pluck('id_detail_layanan'));
        foreach ($rows as $k => $v) {
            $data['data'][$k]['name']               = $v->nama_layanan;
            $data['data'][$k]['counter_layanan']    = ServiceRequest::whereIn('detail_layanan_id', $v->serviceDetail->pluck('id_detail_layanan'))->get()->count();
            $data['data'][$k]['total_request']      = ServiceRequest::all()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 1)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['tata_usaha'][$k]['name']             = $v->nama_detail_layanan;
            $data['tata_usaha'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 3)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['pendidikan_agama'][$k]['name']             = $v->nama_detail_layanan;
            $data['pendidikan_agama'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 8)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['pendidikan_madrasah'][$k]['name']             = $v->nama_detail_layanan;
            $data['pendidikan_madrasah'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 9)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['hajidanumrah'][$k]['name']             = $v->nama_detail_layanan;
            $data['hajidanumrah'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 10)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['masyarakat'][$k]['name']             = $v->nama_detail_layanan;
            $data['masyarakat'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 11)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['masyarakat_kristen'][$k]['name']             = $v->nama_detail_layanan;
            $data['masyarakat_kristen'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 12)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['masyarakat_katolik'][$k]['name']             = $v->nama_detail_layanan;
            $data['masyarakat_katolik'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 13)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['masyarakat_hindu'][$k]['name']             = $v->nama_detail_layanan;
            $data['masyarakat_hindu'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }

        $tataUsaha = ServiceDetail::where('layanan_id', 14)->get();
        foreach ($tataUsaha as $k => $v) {
            $data['masyarakat_budha'][$k]['name']             = $v->nama_detail_layanan;
            $data['masyarakat_budha'][$k]['counter_request']  = ServiceRequest::where('detail_layanan_id', $v->id_detail_layanan)->get()->count();
        }
        // dd($data);

        return $data;
    }

    public static function file($slug)
    {
        $data = Cache::rememberForever("file-$slug", function() use($slug){
            $row = File::where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function dataFile($slug)
    {
        $id = File::where('slug', $slug)->first()->id;
        $data = Cache::rememberForever("filelinkage-$id", function() use($id){
            $row    = FileLinkage::where('file_id', $id)->get();
            return $row;
        });
        return $data;
    }

    public static function office($slug)
    {
        $data = Cache::rememberForever("office-$slug", function() use($slug){
            $row = Office::where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function offices()
    {
        $data = Cache::rememberForever('offices', function(){
            $row = Office::orderBy('title', 'ASC')->get();
            return $row;
        });
        return $data;
    }

    public static function files($category_id)
    {
        $data = Cache::rememberForever("files-$category_id", function() use($category_id){
            $row = File::where('status', 1)->where('category_id', $category_id)->orderBy('created_at', 'DESC')->get();
            return $row;
        });
        return $data;
    }

    public static function video($slug)
    {
        $update_counter = Video::where('slug', $slug)->increment('counter', 1);

        $data = Cache::rememberForever("$slug", function() use($slug){
            $row = Video::where('slug', $slug)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function videos($category = null, $page = null)
    {
        if($category != null){
            $category_id = VideoCategory::where('slug', $category)->first()->id;
            $id = VideoCategory::where('parent_id', $category_id)->pluck('id')->toArray();
            array_push($id, $category_id);

            $data = Cache::remember("videos-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
                if($category_id){
                    $row = Video::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->paginate(12)->withQueryString();
                }else{
                    $row = Video::where('status', 1)->orderBy('published_at', 'DESC')->paginate(12);
                }
                return $row;
            });
        }else{
            $data = Cache::remember("videos-$page", 60 * 60 * 12, function () {
                $row = Video::where('status', 1)->orderBy('published_at', 'DESC')->paginate(12);
                return $row;
            });
        }
        return $data;
    }

    public static function images($id)
    {
        $data = Cache::rememberForever("images-$id", function () use($id) {
            $row = Image::where('status', 1)->where('category_id', $id)->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function photos()
    {
        $data = Cache::rememberForever("photos", function () {
            $row = Photos::where('status', 1)->paginate(10);
            return $row;
        });
        return $data;
    }


    public static function photoDetail($slug)
    {
        $data = Cache::rememberForever("photos-$slug", function () use($slug) {
            $row['parent']      = Photos::where('status', 1)->where('slug', $slug)->first();
            $row['data_photo']  = PhotoContent::where('photo_id', $row['parent']->id)->get();
            $row['author']      = Point::where('modul', 'photo')->where('post_id', $row['parent']->id)->get();
            return $row;
        });
        return $data;
    }

    public static function page($slug)
    {
        $data = Cache::rememberForever("$slug", function() use($slug){
            $row = Page::where('slug', $slug)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function pages($slug, $page = null)
    {
        $category_id = PageCategory::where('slug', $slug)->where('status', 1)->value('id');
        $data = Cache::rememberForever("pages-$category_id-$page", function() use($category_id){
            $rows = Page::where('category_id', $category_id)->where('status', 1)->orderBy('created_at', 'asc')->paginate(20);
            return $rows;
        });
        return $data;
    }

    public static function archives()
    {
        $data = Cache::rememberForever("archives", function() {
            $row = FileCategory::with('getFiles')->where('id', '!=', 1)->orderBy('created_at', 'DESC')->get();
            return $row;
        });
        return $data;
    }

    public static function tags($tag, $page = null)
    {
        $data = Cache::remember("post-$tag-$page", 60 * 60 * 12, function() use($tag){
            $row = Post::where('status', 1)->where('tags', 'LIKE', "%$tag%")->paginate(20)->withQueryString();
            return $row;
        });
        return $data;
    }

    public static function author($slug)
    {
        $data = Cache::rememberForever("user-$slug", function() use($slug){
            $row = User::where('status', 1)->where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function counterPost($code){
        $row = Post::where('code', $code);
        $counter = $row->first()->counter + 1;
        $row = $row->increment('counter', 1);

        return $counter;
    }

    public static function postSlug($slug)
    {
        $data = Post::where('slug', $slug)->first();
        return $data;
    }

    // SULBAR KEMENAG
    public function officers(){
        $data = Cache::rememberForever("officers", function() {
            $rows = Officer::where('status', 1)->orderBy('order', 'asc')->get();
            return $rows;
        });
        return $data;
    }
}
