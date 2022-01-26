<?php

namespace Database\Seeders;

use Database\Seeders\CmsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ThemeSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\RolePermissionSeeder;
use Modules\Faq\Database\Seeders\FaqCategorySeeder;
use Modules\Plan\Database\Seeders\PlanDatabaseSeeder;
use Modules\Newsletter\Database\Seeders\NewsletterDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class, // Role Permission
            SettingSeeder::class, // Setting
            UserSeeder::class, // User
            FaqCategorySeeder::class, //FAQ Category
            ThemeSeeder::class, // Theme
            PlanDatabaseSeeder::class, //priceplan
            CmsSeeder::class, //Cms settings
        ]);
    }
}
