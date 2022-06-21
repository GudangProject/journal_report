<?php

namespace Database\Seeders;

use App\Models\PageCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PageStaticCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageCategory::create([
            'name' => Str::title('e-regulasi'),
            'slug' => Str::slug('e-regulasi'),
            'description' => 'e-regulasi',
            'order' => 0,
            'status' => 1,
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
