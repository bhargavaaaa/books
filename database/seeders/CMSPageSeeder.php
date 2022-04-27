<?php

namespace Database\Seeders;

use App\Models\CmsPage as ModelsCmsPage;
use Illuminate\Database\Seeder;

class CMSPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (ModelsCmsPage::where('name', '=', 'about_us')->first() === null) {
            ModelsCmsPage::create(['name' => 'about_us', 'type' => 'inbuild']);
        }
    }
}
