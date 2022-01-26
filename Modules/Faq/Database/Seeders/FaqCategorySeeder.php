<?php

namespace Modules\Faq\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Faq\Entities\FaqCategory;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        FaqCategory::create([
            'name' => 'Test',
            'slug' => 'test',
            'icon' => 'fas fa-italic'
        ]);
    }
}
