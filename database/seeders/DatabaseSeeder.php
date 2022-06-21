<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // $this->call(MenuSeeder::class);
        // $this->call(PageStaticSeeder::class);
        // $this->call(PageStaticCategorySeeder::class);
        // $this->call(OfficeCategory::class);
        // $this->call(Office::class);
    }
}
