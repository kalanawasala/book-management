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

        //permission of User
        $adminPermissions = ([
            $createPermission = Permission::create(['name' => 'create_users']),
            $getUserPermission = Permission::create(['name' => 'get_users']),
            $editUserPermission = Permission::create(['name' => 'edit_users']),
            $deleteUserPermission = Permission::create(['name' => 'delete_users']),
        ]);

        $userPermissions = [
            $createBookPermission = Permission::create(['name' => 'create_books']),
            $deleteUserPermission = Permission::create(['name' => 'get_books']),
            $editPermission = Permission::create(['name' => 'edit_books']),
            $deleteBookPermission = Permission::create(['name' => 'delete_books']),
        ];



        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Assign permission to roles
        $adminRole->givePermissionTo($adminPermissions);
        $adminRole->givePermissionTo($userPermissions);
        $userRole->givePermissionTo($userPermissions);

        //Assign role to user
        $user = User::find(1); //Example user with ID   
        $user->assignRole('admin');
    }
}
