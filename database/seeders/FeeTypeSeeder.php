<?php

namespace Database\Seeders;

use App\Models\FeeType;
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
        FeeType::create(['name' => 'License Fee']);
        FeeType::create(['name' => 'Revenue']);
        FeeType::create(['name' => 'Spectrum']);
    }
}
