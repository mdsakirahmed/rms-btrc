<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create(['name' => 'DBBL']);
        Bank::create(['name' => 'EBL']);
        Bank::create(['name' => 'City Bank Limited']);
        Bank::create(['name' => 'Brack Bank Limited']);
        Bank::create(['name' => 'One Bank Limited']);
    }
}
