<?php

namespace Database\seeder;

use Modules\V1\Entities\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        //create permission
        $createPermission = Permission::create(['name' => 'create_users']);
        $createBookPermission = Permission::create(['name' => 'create_books']);
        $editPermission = Permission::create(['name' => 'edit_books']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Assign permission to roles
        $adminRole->givePermissionTo($createPermission, $createBookPermission, $editPermission);
        $userRole->givePermissionTo($createBookPermission);

        //Assign role to user
        $user = User::find(1); //Example user with ID   
        $user->assignRole('admin');
    }
}
