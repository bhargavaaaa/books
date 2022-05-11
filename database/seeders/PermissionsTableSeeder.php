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
        if (Permission::where('name', '=', 'Active/Inactive publications')->first() === null) {
            Permission::create(['name' => 'Active/Inactive publications', 'slug' => 'activeinactive.publications', 'description' => 'Can Activate or deactivate publications', 'model' => 'Publication',]);
        }
        /* permission for publication module end */

        /* permission for board module start */
        if (Permission::where('name', '=', 'Create Board')->first() === null) {
            Permission::create(['name' => 'Create Board', 'slug' => 'create.board', 'description' => 'Can Add board', 'model' => 'Board',]);
        }

        if (Permission::where('name', '=', 'View Board')->first() === null) {
            Permission::create(['name' => 'View Board', 'slug' => 'view.board', 'description' => 'Can view board', 'model' => 'Board',]);
        }

        if (Permission::where('name', '=', 'Edit Board')->first() === null) {
            Permission::create(['name' => 'Edit Board', 'slug' => 'edit.board', 'description' => 'Can edit board', 'model' => 'Board',]);
        }

        if (Permission::where('name', '=', 'Delete Board')->first() === null) {
            Permission::create(['name' => 'Delete Board', 'slug' => 'delete.board', 'description' => 'Can Delete board', 'model' => 'Board',]);
        }

        if (Permission::where('name', '=', 'Active/Inactive Board')->first() === null) {
            Permission::create(['name' => 'Active/Inactive board', 'slug' => 'activeinactive.board', 'description' => 'Can Activate or deactivate board', 'model' => 'Board',]);
        }
        /* permission for board module end */

        /* permission for school module start */
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
        if (Permission::where('name', '=', 'Active/Inactive schools')->first() === null) {
            Permission::create(['name' => 'Active/Inactive schools', 'slug' => 'activeinactive.schools', 'description' => 'Can Activate or deactivate schools', 'model' => 'School',]);
        }
        /* permission for school module end */

        /* permission for category module start */
        if (Permission::where('name', '=', 'Create Category')->first() === null) {
            Permission::create(['name' => 'Create Category', 'slug' => 'create.category', 'description' => 'Can Add category', 'model' => 'Category',]);
        }

        if (Permission::where('name', '=', 'View Category')->first() === null) {
            Permission::create(['name' => 'View Category', 'slug' => 'view.category', 'description' => 'Can view category', 'model' => 'Category',]);
        }

        if (Permission::where('name', '=', 'Edit Category')->first() === null) {
            Permission::create(['name' => 'Edit Category', 'slug' => 'edit.category', 'description' => 'Can edit category', 'model' => 'Category',]);
        }

        if (Permission::where('name', '=', 'Delete Category')->first() === null) {
            Permission::create(['name' => 'Delete Category', 'slug' => 'delete.category', 'description' => 'Can Delete category', 'model' => 'Category',]);
        }
        if (Permission::where('name', '=', 'Active/Inactive Category')->first() === null) {
            Permission::create(['name' => 'Active/Inactive Category', 'slug' => 'activeinactive.category', 'description' => 'Can Activate or deactivate categorys', 'model' => 'Category',]);
        }

        /* permission for category module end */

        /* permission for product module start */
        if (Permission::where('name', '=', 'Create products')->first() === null) {
            Permission::create(['name' => 'Create products', 'slug' => 'create.products', 'description' => 'Can Add products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'View products')->first() === null) {
            Permission::create(['name' => 'View products', 'slug' => 'view.products', 'description' => 'Can view products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'Edit products')->first() === null) {
            Permission::create(['name' => 'Edit products', 'slug' => 'edit.products', 'description' => 'Can edit products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'Delete products')->first() === null) {
            Permission::create(['name' => 'Delete products', 'slug' => 'delete.products', 'description' => 'Can Delete products', 'model' => 'Product',]);
        }
        if (Permission::where('name', '=', 'Active/Inactive products')->first() === null) {
            Permission::create(['name' => 'Active/Inactive products', 'slug' => 'activeinactive.products', 'description' => 'Can Activate or deactivate products', 'model' => 'Product',]);
        }

        /* permission for product module start */
        if (Permission::where('name', '=', 'Create products')->first() === null) {
            Permission::create(['name' => 'Create products', 'slug' => 'create.products', 'description' => 'Can Add products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'View products')->first() === null) {
            Permission::create(['name' => 'View products', 'slug' => 'view.products', 'description' => 'Can view products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'Edit products')->first() === null) {
            Permission::create(['name' => 'Edit products', 'slug' => 'edit.products', 'description' => 'Can edit products', 'model' => 'Product',]);
        }

        if (Permission::where('name', '=', 'Delete products')->first() === null) {
            Permission::create(['name' => 'Delete products', 'slug' => 'delete.products', 'description' => 'Can Delete products', 'model' => 'Product',]);
        }
        if (Permission::where('name', '=', 'Active/Inactive products')->first() === null) {
            Permission::create(['name' => 'Active/Inactive products', 'slug' => 'activeinactive.products', 'description' => 'Can Activate or deactivate products', 'model' => 'Product',]);
        }

        /* permission for product module end */

        /* permission for order module start */
        if (Permission::where('name', '=', 'Create orders')->first() === null) {
            Permission::create(['name' => 'Create orders', 'slug' => 'create.orders', 'description' => 'Can Add orders', 'model' => 'Order',]);
        }

        if (Permission::where('name', '=', 'View orders')->first() === null) {
            Permission::create(['name' => 'View orders', 'slug' => 'view.orders', 'description' => 'Can view orders', 'model' => 'Order',]);
        }

        if (Permission::where('name', '=', 'Edit orders')->first() === null) {
            Permission::create(['name' => 'Edit orders', 'slug' => 'edit.orders', 'description' => 'Can edit orders', 'model' => 'Order',]);
        }

        if (Permission::where('name', '=', 'Delete orders')->first() === null) {
            Permission::create(['name' => 'Delete orders', 'slug' => 'delete.orders', 'description' => 'Can Delete orders', 'model' => 'Order',]);
        }
        if (Permission::where('name', '=', 'Active/Inactive orders')->first() === null) {
            Permission::create(['name' => 'Active/Inactive orders', 'slug' => 'activeinactive.orders', 'description' => 'Can Activate or deactivate orders', 'model' => 'Order',]);
        }

        /* permission for order module end */

        /* permission for returnorder module start */
        if (Permission::where('name', '=', 'Create Return Orders')->first() === null) {
            Permission::create(['name' => 'Create Return Orders', 'slug' => 'create.returnorders', 'description' => 'Can Add Return Orders', 'model' => 'ReturnOrder',]);
        }

        if (Permission::where('name', '=', 'View Return Orders')->first() === null) {
            Permission::create(['name' => 'View Return Orders', 'slug' => 'view.returnorders', 'description' => 'Can view Return Orders', 'model' => 'ReturnOrder',]);
        }

        if (Permission::where('name', '=', 'Edit Return Orders')->first() === null) {
            Permission::create(['name' => 'Edit Return Orders', 'slug' => 'edit.returnorders', 'description' => 'Can edit Return Orders', 'model' => 'ReturnOrder',]);
        }

        if (Permission::where('name', '=', 'Delete Return Orders')->first() === null) {
            Permission::create(['name' => 'Delete Return Orders', 'slug' => 'delete.returnorders', 'description' => 'Can Delete Return Orders', 'model' => 'ReturnOrder',]);
        }
        if (Permission::where('name', '=', 'Active/Inactive Return Orders')->first() === null) {
            Permission::create(['name' => 'Active/Inactive Return Orders', 'slug' => 'activeinactive.returnorders', 'description' => 'Can Activate or deactivate Return Orders', 'model' => 'ReturnOrder',]);
        }

        /* permission for order module end */
    }
}
