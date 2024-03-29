<?php

namespace Database\Seeders;

use App\Models\Post;
use Exception;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostImageSeeder extends Seeder
{
    public function run()
    {
        $row = Post::where('image', '!=', null)->orderByDesc('id')->get();


            $destination = public_path('storage/posts/');
            self::checkFolder($destination);

            foreach($row as $k=>$v){
                try{
                    $data = file_get_contents($v->image);
                    $name = basename($v->image);

                    $path_big   = $destination.'big';
                    $path_mid   = $destination.'mid';
                    $path_thumb = $destination.'thumb';


                    $img = Image::make($data);

                    $img->crop(960, 540)->save($path_big.'/'.$name)->destroy();

                    $img->crop(720, 540)->save($path_mid.'/'.$name)->destroy();

                    $img->crop(500, 500)->save($path_thumb.'/'.$name)->destroy();

                    Image::make($path_big.'/'.$name)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_big.'/'.$name)->destroy();

                    Image::make($path_mid.'/'.$name)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_mid.'/'.$name)->destroy();

                    Image::make($path_thumb.'/'.$name)->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_thumb.'/'.$name)->destroy();

                    Post::find($v->id)->update(['image'=>$name]);

                    echo $v->id.'-'.$name.' ✅'. PHP_EOL;
                }catch(Exception $error){
                    echo $error->getMessage().' ❌' . PHP_EOL;
                }
            }
    }

    public static function checkFolder($parentPath){
        if(!file_exists(public_path('storage'))){
            mkdir(public_path('storage'), 0777);
        }
        if(!file_exists(public_path('storage/images'))){
            mkdir(public_path('storage/images'), 0777);
        }
        if(!file_exists($parentPath)){
            mkdir($parentPath, 0777);
        }
        if(!file_exists($parentPath.'big')){
            mkdir($parentPath.'big', 0777);
        }
        if(!file_exists($parentPath.'mid')){
            mkdir($parentPath.'mid', 0777);
        }
        if(!file_exists($parentPath.'thumb')){
            mkdir($parentPath.'thumb', 0777);
        }
    }

    public function runSulsel()
    {
        $row = Post::where('image', '!=', null)->where('id', '>', 55932)->orderByDesc('id')->get();


            $destination = public_path('storage/posts/');
            foreach($row as $k=>$v){
                try{
                    $data = file_get_contents('https://sulsel2020.kemenag.go.id/galeri/berita/thumbnail/'.$v->image);
                    $name = basename($v->image);

                    $path_big   = $destination.'big';
                    $path_mid   = $destination.'mid';
                    $path_thumb = $destination.'thumb';


                    $img = Image::make($data);

                    $img->crop(960, 540)->save($path_big.'/'.$name)->destroy();

                    $img->crop(720, 540)->save($path_mid.'/'.$name)->destroy();

                    $img->crop(500, 500)->save($path_thumb.'/'.$name)->destroy();

                    Image::make($path_big.'/'.$name)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_big.'/'.$name)->destroy();

                    Image::make($path_mid.'/'.$name)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_mid.'/'.$name)->destroy();

                    Image::make($path_thumb.'/'.$name)->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path_thumb.'/'.$name)->destroy();

                    Post::find($v->id)->update(['image'=>$name]);

                    echo $v->id.'-'.$name.' ✅'. PHP_EOL;
                }catch(Exception $error){
                    echo $error->getMessage().' ❌' . PHP_EOL;
                }
            }
    }
}
