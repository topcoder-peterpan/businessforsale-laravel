<?php

namespace Modules\Location\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Location\Entities\City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'https://picsum.photos/id/' . rand(1, 300) . '/700/600';

        return [
            'name' => $this->faker->city(),
            'image' => $image,
        ];
    }
}
