<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $row = DB::connection('old')->table('berita_lama')->groupBy('penulis')->get();

        // echo $row;

        foreach($row as $k=>$v){

            try{
                $save = new User();
                $save->name = $v->penulis;
                $save->slug = Str::slug($v->penulis);
                $save->email = Str::slug($v->penulis).'@mail.com';
                $save->password = Hash::make('sulsel2022');
                $save->user_type = 'k,e';
                $save->status = 1;
                $save->save();

                echo "Penulis: $v->penulis" . PHP_EOL;
            }catch(Exception $error){
                echo $error->getMessage();
            }



        }

    }

    // public function run()
    // {
    //     $admin = User::create([
    //         'name' => 'Admin',
    //         'slug' => Str::slug('Admin'),
    //         'email' => 'mifhai@yahoo.com',
    //         'status' => 1,
    //         'password' => Hash::make('12345678'),
    //     ]);
    //     $admin->assignRole('author');
    // }
}
