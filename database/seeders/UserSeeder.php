<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $admin = User::create([
            'name' => 'Mr. Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        //User
        $user = User::create([
            'name' => 'Mr. User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('user');
    }
}
