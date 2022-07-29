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

class PostWpSeeder extends Seeder
{
    public function run()
    {
        $row = DB::connection('old')->table('wp27_posts')->where('post_type', 'attachment')->get();
            foreach($row as $k=>$v){
                try{
                    
                // $name = basename($v->guid);

                DB::table('posts')->update(['tags'=>null]);
                

                echo '✅ '.$v->title. PHP_EOL;
                // sleep(0.2);

            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }

    public function runPost()
    {
        $row = DB::connection('old')->table('wp27_posts')->where('post_type', 'post')->orderBy('post_date', 'ASC')->get();
            foreach($row as $k=>$v){
                try{

                $save = new Post();
                $save->code = Str::random(5);
                $save->prefix = null;
                $save->title = $v->post_title;
                $save->slug = Str::slug($v->post_title);
                $save->preview = Str::words($v->post_content, 20, '');
                $save->content = $v->post_content;
                // $save->image = end(explode('/', $v->gambar ));
                // $save->image = str_replace(' ', '%20', $v->gambar);
                $save->caption = 'Illustrasi Foto (Kemenag RI Provinsi Sulawesi Sulbar)';
                $save->tags = $v->ID;
                $save->counter = rand(219,2319);
                $save->type = 1;
                $save->status = 1;
                $save->category_id = 2;
                $save->created_by = 2;
                $save->updated_by = null;
                $save->published_at = $v->post_date;
                $save->created_at = $v->post_date;
                $save->updated_at = null;
                $save->save();
                $save->refresh();

                // if(!$editor_id){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = 'e';
                    $save_point->user_id = 2;
                    $save_point->category_id = $save->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = 1;
                    $save_point->save();
                // }

                // if(!$penulis_id){
                    // $save_point = new Point();
                    // $save_point->modul = 'post';
                    // $save_point->user_type = 'k';
                    // $save_point->user_id = $penulis_id ?? 2;
                    // $save_point->category_id = $save->category_id;
                    // $save_point->post_id = $save->id;
                    // $save_point->point = 2;
                    // $save_point->save();
                // }

                echo '✅ '.$v->post_title. PHP_EOL;
                // sleep(0.2);

            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }
}
