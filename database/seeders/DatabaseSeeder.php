<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // \App\Models\User::factory(10)->create();
        // Model::unguard();
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(CMSPageSeeder::class);
        // Model::reguard();
    }
}
