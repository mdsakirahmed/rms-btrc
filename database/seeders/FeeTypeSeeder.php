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
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 1,
            'ending_month' => 12,
        ]);

        //1
        $fee_type =  FeeType::create([
            'name' => 'Revenue Sharing', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 1,
            'ending_month' => 2,
        ]);

        //2
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 3,
            'ending_month' => 4,
        ]);

        //3
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 5,
            'ending_month' => 6,
        ]);

        //4
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 7,
            'ending_month' => 8,
        ]);

        //5
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 9,
            'ending_month' => 10,
        ]);

        //6
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 11,
            'ending_month' => 12,
        ]);

        $fee_type = FeeType::create([
            'name' => 'Spectrum Charge', 
            'schedule_day' => 20, 
            'schedule_month' => 0, 
            'period_format' => 2,
            'schedule_include_to_beginning_of_period' => false
        ]);
        //1
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 1,
            'ending_month' => 3,
        ]);
        //2
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 4,
            'ending_month' => 6,
        ]);
        //3
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 7,
            'ending_month' => 9,
        ]);
        //4
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 10,
            'ending_month' => 12,
        ]);
    }
}
