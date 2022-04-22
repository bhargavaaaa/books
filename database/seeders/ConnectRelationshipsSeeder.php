<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Get Admin User
         */
        $adminUser = User::where('email', 'admin@gmail.com')->first();

        

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('name', '=', 'Admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

        /**
         * Attach User to Role
         */
        $adminUser->attachRole($roleAdmin);

        
    }
}
