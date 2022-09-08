<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScreensController extends Controller
{
    public function offices(DataController $data)
    {
        return view('client.screens.offices', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'data'=>$data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
        ]);
    }

    public function services(DataController $data)
    {
        return view('client.screens.services', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'=>$data->services('layanan-wilayah'),
        ]);
    }

    public function files(DataController $data)
    {
        return view('client.screens.files', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'popular'=>$data->popular(),
            'data'=>$data->files(1),
        ]);
    }

    public function posts(Request $request, $category, DataController $data)
    {
        // dd($category);
        return view('client.screens.posts',[
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu' => $data->menu(),
            'menu_office' => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos('video'),
            'files'         => $data->files(1),
            'data' => $data->postsCategory($category, $request->page),
            'title' => $category,
        ]);
    }

    public function archives(DataController $data)
    {
        return view('client.screens.archives', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->archives(),
        ]);
    }

    public function videos(Request $request, $category = null, DataController $data)
    {
        return view('client.screens.videos', [
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'       => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->videos($category, $request->page),
            'title'         => Str::upper($category),
            'data_kepegawaian' => $data->files(3),
        ]);
    }

    public function podcasts(Request $request, DataController $data)
    {
        return view('client.screens.podcasts', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->videos('podcast', $request->page),
        ]);
    }

    public function pages($category, DataController $data)
    {
        return view('client.screens.pages',[
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'title'         => Str::title($category),
            'data'          => $data->pages($category),
            'popular'      => $data->popular()
        ]);
    }

    public function infografis(DataController $data)
    {
        return view('client.screens.infografis', [
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->images(4),
        ]);
    }

    public function tags(Request $request, $q, DataController $data)
    {
        return view('client.screens.tags', [
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'popular'      => $data->popular(),
            'title'         => Str::title($q),
            'data'          => $data->tags($q, $request->page),
        ]);
    }

    public function search(Request $request, DataController $data){
        return view('client.screens.search',[
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'files'     => $data->files(1),
            'menu'      => $data->menu(),
            'data'      => $data->search($request->q),
            'popular'  => $data->popular(),
            'infografis'    => $data->images(4),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'title'     => "Hasil Pencarian: $request->q",
        ]);
    }

    public function officers(DataController $data){
        return view('client.screens.officers',[
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'title'         => 'Struktur Organisasi',
            'data'          => $data->officers(),
            'popular'       => $data->popular()
        ]);
    }

    public function photos(DataController $data){
        return view('client.screens.photos',[
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'files'         => $data->files(1),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            // 'title'         => 'Struktur Organisasi',
            'data'          => $data->photos(),
            'popular'       => $data->popular()
        ]);
    }
}
