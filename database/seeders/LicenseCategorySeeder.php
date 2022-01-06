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
        License::create([
            'user_id' => '2',
            'license_category_id' => '1',
            'license_sub_category_id' => null,
            'license_number' => 'BTRC/LL/Mobile/GP(1)/2011-01',
            'fee' => '100',
            'instalment' => '10',
            'issue_date' => '11/11/1996',
            'expire_date' => '10/11/2026',
            'renewal_date' => '11/11/2026',
            'name' => 'Grameen Phone Limited',
            'address' => 'GP House Bashundhara, Baridhara Dhaka-1229.',
            'contac_number' => '02-9882990, 02-9882970',
            'website' => 'www.grameenphone.com',
            'name_and_designation_of_the_contact_person' => 'Imtiaz Shafiq, General Manager',
            'mobile_number_of_contact_person' => '01711505794 ',
        ]);

        LicenseCategory::create(['name' => '3G Cellular Mobile Telecom Operator']);
        License::create([
            'user_id' => '2',
            'license_category_id' => '2',
            'license_sub_category_id' => null,
            'license_number' => 'BTRC/LL/3G(1)GP/2013-1',
            'fee' => '100',
            'instalment' => '10',
            'issue_date' => '12/9/2013',
            'expire_date' => '11/9/2028',
            'renewal_date' => '12/9/2028',
            'name' => 'Grameen Phone Limited',
            'address' => 'GP House Bashundhara, Baridhara Dhaka-1229.',
            'contac_number' => '02-9882990, 02-9882970',
            'website' => 'www.grameenphone.com',
            'name_and_designation_of_the_contact_person' => 'Imtiaz Shafiq, General Manager',
            'mobile_number_of_contact_person' => '01711505794',
        ]);

        LicenseCategory::create(['name' => '4G/LTE Cellular Mobile Telecom Operator']);
        License::create([
            'user_id' => '2',
            'license_category_id' => '3',
            'license_sub_category_id' => null,
            'license_number' => '14.32.0000.007.51.082.18.1',
            'fee' => '100',
            'instalment' => '10',
            'issue_date' => '19-02-2018',
            'expire_date' => '18-02-2033',
            'renewal_date' => '19-02-2033',
            'name' => 'Teletalk Bangladesh Limited',
            'address' => 'Telecommunication Building, 37/E, Eskaton Garden Road, Ramna, Dhaka1000',
            'contac_number' => '02-9851060',
            'website' => 'www.teletalk.com.bd',
            'name_and_designation_of_the_contact_person' => 'Md. Golam Sabidur Hossain, Regulatory & Corporate Relation',
            'mobile_number_of_contact_person' => '1550157507, golam.sabidur@teletalk.com.bd',
        ]);

        LicenseCategory::create(['name' => 'Mobile Number Portability Services (MNPS)']);
        LicenseCategory::create(['name' => 'Broadband Wireless Access (BWA)']);
        LicenseCategory::create(['name' => 'International Gateway (IGW) Services']);
        LicenseCategory::create(['name' => 'Interconnection Exchange (ICX) Services']);
        LicenseCategory::create(['name' => 'International Internet Gateway (IIG) Services']);
        LicenseCategory::create(['name' => 'National Internet Exchange (NIX)']);
        LicenseCategory::create(['name' => 'Call Centre (International & Domestic)']);
    }
}
