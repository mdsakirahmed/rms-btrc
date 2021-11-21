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
        $permission = Permission::create(['name' => 'manage user permission']);
        $permission->assignRole($admin_role);
        $permission = Permission::create(['name' => 'user management']);
        $permission->assignRole($admin_role);
    }
}
