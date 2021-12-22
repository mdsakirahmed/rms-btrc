<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role
        $admin_role = Role::create(['name' => 'admin']);
        $user_role  = Role::create(['name' => 'user']);

        //Permission
        Permission::create(['name' => 'my-dashboard'])->assignRole([$admin_role, $user_role]);
        Permission::create(['name' => 'permission-management'])->assignRole($admin_role);
        Permission::create(['name' => 'product-list'])->assignRole($admin_role);
        Permission::create(['name' => 'product-export'])->assignRole($admin_role);
        Permission::create(['name' => 'product-import'])->assignRole($admin_role);
        Permission::create(['name' => 'user'])->assignRole($admin_role);
        Permission::create(['name' => 'document'])->assignRole($admin_role);
        Permission::create(['name' => 'license-category'])->assignRole($admin_role);
        Permission::create(['name' => 'license-sub-category'])->assignRole($admin_role);
        Permission::create(['name' => 'operator'])->assignRole($admin_role);
        Permission::create(['name' => 'receiver-fee'])->assignRole($admin_role);
        Permission::create(['name' => 'receiver-period'])->assignRole($admin_role);
        Permission::create(['name' => 'payment-receive'])->assignRole($admin_role);
        Permission::create(['name' => 'license'])->assignRole($admin_role);
        Permission::create(['name' => 'report'])->assignRole($admin_role);

        //
        Permission::create(['name' => 'my-license'])->assignRole($user_role);
    }
}
