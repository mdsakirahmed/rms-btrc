<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Operator::factory(5000)->create();
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FeeTypeSeeder::class);
        $this->call(LicenseCategorySeeder::class);
        $this->call(LicenseSubCategorySeeder::class);
        $this->call(BankSeeder::class);

    }
}
