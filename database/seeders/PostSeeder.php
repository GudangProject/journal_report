<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Point;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function runDup(){
        $duplicated = DB::table('posts')
                    ->select('title', DB::raw('count(`title`) as occurences'))
                    ->groupBy('title')
                    ->having('occurences', '>', 1)
                    ->get();

        foreach ($duplicated as $duplicate) {
            Post::where('title', $duplicate->title)->first()->delete();
            echo $duplicate->title;
        }
    }

    public function runImage()
    {
        $row = Post::get();

        foreach($row as $item){
            $save = Post::find($item->id);
            $save->image = end(explode('/', $item->image ));
            $save->save();
            echo $item->image.' ✅'.PHP_EOL;
        }
    }

    public function run()
    {
        $row = Page::get();
        foreach($row as $item){
            try{
                $save = Page::find($item->id);
                $save->content = Str::replace('https://sulsel.', 'https://sulsel2020.', $item->content);
                $save->save();
                echo $item->title.' ✅'.PHP_EOL;
            }catch(Exception $e){
                echo $e->getMessage().' ❌'.PHP_EOL;
            }
        }
    }

    public function runContent()
    {
        $row = Post::get();
        foreach($row as $item){
            try{
                $save = Post::find($item->id);
                $save->content = Str::replace('https://sulsel.', 'https://sulsel2020.', $item->content);
                $save->save();
                echo $item->title.' ✅'.PHP_EOL;
            }catch(Exception $e){
                echo $e->getMessage().' ❌'.PHP_EOL;
            }
        }
    }

    public function runPost()
    {
        $row = DB::connection('old')->table('berita')->where('tanggalInfo', '>', '2022-04-19 08:21:04')->orderBy('tanggalInfo', 'DESC')->get();
            foreach($row as $k=>$v){
                try{
                $editor_id = User::where('name', $v->editor)->first()->id;
                $penulis_id = User::where('name', $v->penulis)->first()->id;


                $save = new Post();
                $save->code = Str::random(5);
                $save->prefix = null;
                $save->title = $v->judul;
                $save->slug = Str::slug($v->judul);
                $save->preview = Str::words($v->isi, 20, '');
                $save->content = $v->isi;
                // $save->image = end(explode('/', $v->gambar ));
                $save->image = str_replace(' ', '%20', $v->gambar);
                $save->caption = 'Illustrasi Foto (Kemenag RI Provinsi Sulawesi Selatan)';
                $save->tags = null;
                $save->counter = $v->hits;
                $save->type = ($v->slideShow == 'Off' ? '1' : '2');
                $save->status = 1;
                $save->category_id = ($v->kategori == 'Berita Kontributor' ? '3' : '2');
                $save->created_by = $editor_id ?? 2;
                $save->updated_by = null;
                $save->published_at = $v->tanggalTerbit;
                $save->created_at = $v->tanggalInfo;
                $save->updated_at = null;
                $save->save();
                $save->refresh();

                // if(!$editor_id){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = 'e';
                    $save_point->user_id = $editor_id ?? 2;
                    $save_point->category_id = $save->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = 1;
                    $save_point->save();
                // }

                // if(!$penulis_id){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = 'k';
                    $save_point->user_id = $penulis_id ?? 2;
                    $save_point->category_id = $save->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = 2;
                    $save_point->save();
                // }


                echo '✅ '.$v->judul. PHP_EOL;
                // sleep(0.2);

            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }
}
