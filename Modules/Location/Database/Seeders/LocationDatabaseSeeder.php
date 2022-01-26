<?php

namespace Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        City::factory(8)->create();
        Town::factory(30)->create();
    }
}
