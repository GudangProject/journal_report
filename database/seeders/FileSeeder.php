<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\FileLinkage;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileSeeder extends Seeder
{
    public function run()
    {
        $row = File::get();

        foreach($row as $item){
            try{
                $save = new FileLinkage();
                $save->name = $item->name;
                $save->type = $item->type;
                $save->size = $item->size;
                $save->file_id = $item->id;
                $save->save();

                echo $item->name;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function runFiles()
    {
        $row = DB::connection('old')->table('info')->get();

        foreach($row as $item){
            try{
                $save = new File();
                $save->title = $item->judul;
                $save->slug = Str::slug($item->judul);
                $save->created_by = 1;
                $save->created_at = $item->tanggalTerbit;
                $save->category_id = 1;
                $save->name = $item->file;
                $save->type = 'application/pdf';
                $save->size = 0;
                $save->status = 1;
                $save->save();

                echo '✅ '.$save->title. PHP_EOL;
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }
}
