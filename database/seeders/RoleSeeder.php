<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create([
        //     'name' => 'super admin',
        //     'guard_name' => 'web'
        // ]);

        // Role::create([
        //     'name' => 'admin',
        //     'guard_name' => 'web'
        // ]);
        Role::create([
            'name' => 'author',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'pic',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'finance',
            'guard_name' => 'web'
        ]);
    }
}
