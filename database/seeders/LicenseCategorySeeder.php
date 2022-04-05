<?php

namespace Database\Seeders;

use App\Models\License;
use App\Models\LicenseCategory;
use Illuminate\Database\Seeder;

class LicenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicenseCategory::create(['name' => '2G Cellular Mobile Telecom Operator', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '3G Cellular Mobile Telecom Operator', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '4G/LTE Cellular Mobile Telecom Operator', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'Mobile Number Portability Services (MNPS)', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'Broadband Wireless Access (BWA)', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'International Gateway (IGW) Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'Interconnection Exchange (ICX) Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'International Internet Gateway (IIG) Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'National Internet Exchange (NIX)', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => 'Call Centre (International & Domestic)', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
    }
}
