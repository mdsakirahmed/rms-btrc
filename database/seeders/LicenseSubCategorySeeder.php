<?php

namespace Database\Seeders;

use App\Models\LicenseSubCategory;
use Illuminate\Database\Seeder;

class LicenseSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicenseSubCategory::create(['name' => 'No Sub Category']);
        LicenseSubCategory::create(['name' => 'Sub Category 1']);
        LicenseSubCategory::create(['name' => 'Sub Category 2']);
        LicenseSubCategory::create(['name' => 'Sub Category 3']);
        LicenseSubCategory::create(['name' => 'Sub Category 4']);
        LicenseSubCategory::create(['name' => 'Sub Category 5']);
    }
}
