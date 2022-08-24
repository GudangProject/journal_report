<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(DataController $data)
    {
        // dd($data->posts(null));
        return view('client.index', [
            'menu' => $data->menu(),
            'menu_office' => $data->offices(),
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'files' => $data->files(1),
            'headline' => $data->headline(),
            'popular' => $data->popular(),
            'main_services' => $data->services('layanan-utama'),
            'services' => $data->services('layanan-wilayah'),
            'infografis' => $data->images(4),
            'video' => $data->videos('video'),
            'podcast' => $data->videos('podcast'),
            'terbaru' => $data->posts(null),
            // 'wilayah' => $data->posts('wilayah'),
            'daerah' => $data->posts('daerah'),
            'article' => $data->posts('article'),
        ]);
    }
}
