<?php

namespace Modules\Ad\Database\factories;

use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Brand\Entities\Brand;
use Modules\Location\Entities\City;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Location\Entities\Town;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ad\Entities\Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(10, 600);
        $title = $this->faker->sentence($nbWords = 3, $variableNbWords = true);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'subcategory_id' => SubCategory::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'town_id' => Town::inRandomOrder()->first()->id,
            'model' => 'V2066',
            'condition' => Arr::random(["used", "new"]),
            'authenticity' => Arr::random(["original", "refurbished"]),
            'negotiable' => Arr::random([true, false]),
            'price' => rand(100, 550),
            'description' => $this->faker->paragraph,
            'phone' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'thumbnail' => $image,
            'status' => Arr::random(["active", "expired"]),
            'featured' => rand(true, false),
            'total_reports' => rand(1, 30),
            'total_views' => rand(1, 300),
            'is_blocked' => rand(true, false),
        ];
    }
}
