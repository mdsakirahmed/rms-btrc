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
        $fee_type = FeeType::create(['name' => 'License Fee']);
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 1,
            'ending_month' => 12,
            'schedule_day' => 0,
            'schedule_month' => 2,
        ]);

        //1
        $fee_type =  FeeType::create(['name' => 'Revenue']);
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 1,
            'ending_month' => 2,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        //2
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 3,
            'ending_month' => 4,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        //3
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 5,
            'ending_month' => 6,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        //4
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 7,
            'ending_month' => 8,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        //5
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 9,
            'ending_month' => 10,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        //6
        FeeTypeWisePeriod::create([
            'fee_type_id' => $fee_type->id,
            'starting_month' => 11,
            'ending_month' => 12,
            'schedule_day' => 20,
            'schedule_month' => 0,
        ]);

        FeeType::create(['name' => 'Spectrum']);
    }
}
