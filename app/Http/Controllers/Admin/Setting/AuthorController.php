<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Post;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.authors.index');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $data['user']           = User::findOrFail($id);
        $data['posts_count']    = Post::where('created_by', $id)->get()->count();
        $data['posts_point']    = Point::where('user_id', $id)->sum('point');

        return view('admin.authors.detail.detail', [
            'data' => $data,
        ]);
    }


    public function edit($id)
    {
        $user                   = User::findOrFail($id);
        $user_type              = str_replace(',', '', $user->user_type);

        $data['user']           = $user;
        $data['roles']          = Roles::all();
        $data['current_role']   = str_replace(array('[', ']', '"'), '', $user->getRoleNames());
        $data['user_type']      = str_split($user_type);

        return view('admin.authors.edit', ['data' => $data]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public static function posts($id){
        $rows = Post::where('status', 1)->where('created_by', $id)->orderBy('published_at', 'desc')->paginate(20);

        foreach ($rows as $k => $v) {
            $data['data'][$k]['id']         = $v->id;
            $data['data'][$k]['title']      = Str::title($v->title);
            $data['data'][$k]['category']   = $v->getCategory->name;
            $data['data'][$k]['publish']    = $v->date;
            $data['data'][$k]['status']     = $v->status;
            $data['data'][$k]['view']       = $v->counter;
            $data['data'][$k]['url']        = $v->url;
        }

        return $data;
    }
}
