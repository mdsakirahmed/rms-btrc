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
        //Permissions
        Permission::create(['name' => 'my-dashboard']);
        Permission::create(['name' => 'application']);
        Permission::create(['name' => 'permission-management']);
        Permission::create(['name' => 'product-list']);
        Permission::create(['name' => 'product-export']);
        Permission::create(['name' => 'product-import']);
        Permission::create(['name' => 'user']);
        Permission::create(['name' => 'document']);
        Permission::create(['name' => 'payment-method']);
        Permission::create(['name' => 'license-category']);
        Permission::create(['name' => 'license-sub-category']);
        Permission::create(['name' => 'operator']);
        Permission::create(['name' => 'receiver-fee']);
        Permission::create(['name' => 'receiver-period']);
        Permission::create(['name' => 'payment-receive']);
        Permission::create(['name' => 'license']);
        Permission::create(['name' => 'report']);
        Permission::create(['name' => 'payment']);
        Permission::create(['name' => 'git']);

        //Role
        $role = Role::create(['name' => 'admin']);
        $role->syncPermissions(Permission::all());
    }
}
