<?php

namespace Database\Seeders;

use App\Models\DashboardCard;
use Illuminate\Database\Seeder;

class DashboardCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardCard::insert([
            ['title' => 'Title 1', 'value' => 100, 'color' => '#03A9F3'],
            ['title' => 'Title 2', 'value' => 200, 'color' => '#208837'],
            ['title' => 'Title 3', 'value' => 300, 'color' => '#00C292'],
            ['title' => 'Title 4', 'value' => 400, 'color' => '#343A40'],
            ['title' => 'Title 5', 'value' => 500, 'color' => '#01C0C8'],
            ['title' => 'Title 6', 'value' => 600, 'color' => '#FEC107'],
        ]);
    }
}
