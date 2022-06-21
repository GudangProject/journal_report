<?php

namespace Database\Seeders;

use App\Models\OfficeCategory as ModelsOfficeCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OfficeCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsOfficeCategory::insert([
            'name' => 'Kantor',
            'slug' => 'kantor',
            'description' => 'kantor cabang sulsel pendis',
            'status' => 1,
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
