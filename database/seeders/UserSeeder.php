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
        $admin = User::create([
            'name' => 'Admin',
            'slug' => Str::slug('Admin'),
            'email' => 'admin@yahoo.com',
            'status' => 1,
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('author');
    }
}
