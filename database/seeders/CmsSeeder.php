<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cms::create([
            'terms_body'    =>  '',
            'about_body'    =>  '',
            'privacy_body'    =>  '',
            'posting_rules_body'    =>  '',
        ]);
    }
}
