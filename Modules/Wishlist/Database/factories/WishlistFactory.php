<?php

namespace Modules\Wishlist\Database\factories;

use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Entities\Product;

class WishlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Wishlist\Entities\Wishlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'ad_id' => 1,
        ];
    }
}
