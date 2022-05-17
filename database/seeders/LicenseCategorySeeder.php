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
        LicenseCategory::create(['name' => '(MNPS) Mobile Number Portability Services ', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(BWA) Broadband Wireless Access ', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(IGW) International Gateway  Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(ICX) Interconnection Exchange  Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(IIG) International Internet Gateway  Services', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(NIX) National Internet Exchange ', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
        LicenseCategory::create(['name' => '(International & Domestic) Call Centre ', 'duration_year' => rand(3,10), 'duration_month' => rand(2,11)]);
    }
}
