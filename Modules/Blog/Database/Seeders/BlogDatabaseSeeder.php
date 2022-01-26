<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Tag\Entities\Tag;
use Illuminate\Database\Seeder;
use Modules\Blog\Entities\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Post::factory(50)->create();

        for ($i = 0; $i < 500; $i++) {
            DB::table('post_tag')->insert(
                [
                    'post_id' => Post::inRandomOrder()->first()->id,
                    'tag_id' => Tag::inRandomOrder()->first()->id,
                ]
            );
        }
    }
}
