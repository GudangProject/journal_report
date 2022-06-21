<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class ScreenController extends Controller
{
    public function redirect($category, $slug, DataController $data)
    {
        $row = $data->postSlug($slug);
        return redirect($row->url);

    }

    public function post($category, $slug, $code, DataController $data)
    {
        $row = $data->post($code);

        if($row){
            return view('client.screen.post', [
                'meta'          => $data->post($code),
                'banner_header' => $data->images(1),
                'banner_home'   => $data->images(2),
                'banner_footer' => $data->images(3),
                'menu'          => $data->menu(),
                'menu_office'   => $data->offices(),
                'data'          => $row,
                'posts'         => $data->posts($category),
                'infografis'    => $data->images(4),
                'video'         => $data->videos(),
                'files'         => $data->files(1),
                'counter'       => $data->counterPost($code),
                'popular'       => $data->popular()
            ]);
        }else{
            return redirect(env('APP_URL'));
        }
    }

    public function file($slug, DataController $data)
    {
        return view('client.screen.file',[
            'menu'          => $data->menu(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu_office'   => $data->offices(),
            'data'          => $data->file($slug),
            'data_file'     => $data->dataFile($slug),
            'popular'       => $data->popular(),
            'files'         => $data->files(1),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
        ]);
    }

    public function office($slug, DataController $data)
    {
        return view('client.screen.office',[
            'menu'          => $data->menu(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu_office'   => $data->offices(),
            'data'          => $data->office($slug),
            'posts'         => $data->postOffice($slug),
        ]);
    }

    public function page($slug, DataController $data)
    {
        return view('client.screen.page-static',[
            'meta'          => $data->page($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'data'          => $data->page($slug),
            'popular'       => $data->popular(),
            'files'         => $data->files(1),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
        ]);
    }

    public function video($slug, DataController $data)
    {
        return view('client.screen.video',[
            'meta'          => $data->video($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'data'          => $data->video($slug),
            'files'         => $data->files(1),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'popular'       => $data->popular()
        ]);
    }

    public function author(Request $request, $slug, DataController $data)
    {
        return view('client.screen.author',[
            'meta'          => $data->video($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'author'        => $data->author($slug),
            'data'          => $data->postAuthor($slug, $request->page),
            'files'         => $data->files(1),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'popular'       => $data->popular()
        ]);
    }
}
