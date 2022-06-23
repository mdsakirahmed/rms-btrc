<?php

namespace Database\Seeders;

use App\Models\FeeType;
use App\Models\FeeTypeWisePeriod;
use Illuminate\Database\Seeder;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fee_type = FeeType::create([
            'name' => 'License Fee', 
            'schedule_day' => 0, 
            'schedule_month' => 2, 
            'period_format' => 1,
            'schedule_include_to_beginning_of_period' => true
        ]);


        //1
        $fee_type =  FeeType::create([
            'name' => 'Revenue Sharing', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);


        $fee_type = FeeType::create([
            'name' => 'Spectrum Charge', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);

        $fee_type = FeeType::create([
            'name' => 'Admin Fine', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);
       
        $fee_type = FeeType::create([
            'name' => 'Others', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);
    }
}
