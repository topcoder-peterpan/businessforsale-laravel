<?php

namespace Modules\Ad\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdFeature;
use Modules\Ad\Entities\AdGallery;

class AdDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Ad::factory(100)->create();
        AdGallery::factory(1000)->create();
        AdFeature::factory(200)->create();
    }
}
