<?php

namespace Database\Seeders;

use App\Models\Point;
use App\Models\Post;
use ErrorException;
use Exception;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    public function run()
    {
        $row = Post::where('status', 1)->orderByDesc('published_at')->get();

        foreach($row as $k=>$v){
            try{
                Point::where('post_id', $v->id)->update([
                    'created_at'=>$v->published_at,
                    'updated_at'=>$v->published_at,
                ]);
                echo $v->title.' ✅'.PHP_EOL;
            }catch(Exception $e){
                echo $e->getMessage().' ❌'.PHP_EOL;

            }
        }
    }
}
