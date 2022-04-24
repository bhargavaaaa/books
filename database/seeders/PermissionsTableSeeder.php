<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */


        /* permission for User module start */
        if (Permission::where('name', '=', 'Create User')->first() === null) {
            Permission::create(['name' => 'Create User', 'slug' => 'create.users', 'description' => 'Can Add Users', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'View User')->first() === null) {
            Permission::create(['name' => 'View User', 'slug' => 'view.users', 'description' => 'Can View User', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Edit User')->first() === null) {
            Permission::create(['name' => 'Edit User', 'slug' => 'edit.users', 'description' => 'Can Edit User', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Delete User')->first() === null) {
            Permission::create(['name' => 'Delete User', 'slug' => 'delete.users', 'description' => 'Can Delete User', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Active/Inactive User')->first() === null) {
            Permission::create(['name' => 'Active/Inactive User', 'slug' => 'activeinactive.users', 'description' => 'Can Activate or Deactivate User', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Approve/Disapprove User')->first() === null) {
            Permission::create(['name' => 'Approve/Disapprove User', 'slug' => 'approvedisapprove.users', 'description' => 'Can Approve or Disapprove User', 'model' => 'User',]);
        }
        /* permission for Role module end */




        /* permission for Role module start */
        if (Permission::where('name', '=', 'Create Roles')->first() === null) {
            Permission::create(['name' => 'Create Roles', 'slug' => 'create.roles', 'description' => 'Can Add roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'View Roles')->first() === null) {
            Permission::create(['name' => 'View Roles', 'slug' => 'view.roles', 'description' => 'Can view roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'Edit Roles')->first() === null) {
            Permission::create(['name' => 'Edit Roles', 'slug' => 'edit.roles', 'description' => 'Can edit roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'Delete Roles')->first() === null) {
            Permission::create(['name' => 'Delete Roles', 'slug' => 'delete.roles', 'description' => 'Can Delete Roles', 'model' => 'Role',]);
        }

        /* if (Permission::where('name', '=', 'Active/Inactive Roles')->first() === null) {
            Permission::create(['name' => 'Active/Inactive Roles', 'slug' => 'activeinactive.roles', 'description' => 'Can Activate or deactivate roles', 'model' => 'Role',]);
        }*/

        /* permission for publication module start */
        if (Permission::where('name', '=', 'Create publications')->first() === null) {
            Permission::create(['name' => 'Create publications', 'slug' => 'create.publications', 'description' => 'Can Add publications', 'model' => 'Publication',]);
        }

        if (Permission::where('name', '=', 'View publications')->first() === null) {
            Permission::create(['name' => 'View publications', 'slug' => 'view.publications', 'description' => 'Can view publications', 'model' => 'Publication',]);
        }

        if (Permission::where('name', '=', 'Edit publications')->first() === null) {
            Permission::create(['name' => 'Edit publications', 'slug' => 'edit.publications', 'description' => 'Can edit publications', 'model' => 'Publication',]);
        }

        if (Permission::where('name', '=', 'Delete publications')->first() === null) {
            Permission::create(['name' => 'Delete publications', 'slug' => 'delete.publications', 'description' => 'Can Delete publications', 'model' => 'Publication',]);
        }

        /* permission for publication module end */

        /* permission for publication module start */
        if (Permission::where('name', '=', 'Create schools')->first() === null) {
            Permission::create(['name' => 'Create schools', 'slug' => 'create.schools', 'description' => 'Can Add schools', 'model' => 'School',]);
        }

        if (Permission::where('name', '=', 'View schools')->first() === null) {
            Permission::create(['name' => 'View schools', 'slug' => 'view.schools', 'description' => 'Can view schools', 'model' => 'School',]);
        }

        if (Permission::where('name', '=', 'Edit schools')->first() === null) {
            Permission::create(['name' => 'Edit schools', 'slug' => 'edit.schools', 'description' => 'Can edit schools', 'model' => 'School',]);
        }

        if (Permission::where('name', '=', 'Delete schools')->first() === null) {
            Permission::create(['name' => 'Delete schools', 'slug' => 'delete.schools', 'description' => 'Can Delete schools', 'model' => 'School',]);
        }

        /* permission for publication module end */
    }
}
