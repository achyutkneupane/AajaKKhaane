<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'om',
            'user',
        ];

        $permissions = [
            'can vote',
            'can set absent',
            'can add bills'
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $user = \App\Models\User::where('username', 'achyut')->first();
        $user->assignRole('admin');

        $user = \App\Models\User::where('username', 'aditi')->first();
        $user->assignRole('om');

        $users = \App\Models\User::where('username', '!=', 'achyut')->where('username', '!=', 'aditi')->get();
        foreach ($users as $user) {
            $user->assignRole('user');
        }

        $users = \App\Models\User::get();
        foreach($users as $user){
            $user->givePermissionTo('can vote');
        }
    }
}