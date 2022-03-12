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
        LicenseCategory::create(['name' => '2G Cellular Mobile Telecom Operator']);
        LicenseCategory::create(['name' => '3G Cellular Mobile Telecom Operator']);
        LicenseCategory::create(['name' => '4G/LTE Cellular Mobile Telecom Operator']);
        LicenseCategory::create(['name' => 'Mobile Number Portability Services (MNPS)']);
        LicenseCategory::create(['name' => 'Broadband Wireless Access (BWA)']);
        LicenseCategory::create(['name' => 'International Gateway (IGW) Services']);
        LicenseCategory::create(['name' => 'Interconnection Exchange (ICX) Services']);
        LicenseCategory::create(['name' => 'International Internet Gateway (IIG) Services']);
        LicenseCategory::create(['name' => 'National Internet Exchange (NIX)']);
        LicenseCategory::create(['name' => 'Call Centre (International & Domestic)']);
    }
}
