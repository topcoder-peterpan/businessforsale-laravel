<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Modules\Plan\Entities\Plan;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_id'   => $this->faker->unique()->numerify('##########'),
            'payment_type' => Arr::random(['stripe', 'razorpay']),
            'plan_id'      => Plan::inRandomOrder()->first()->id,
            'customer_id'  => Customer::inRandomOrder()->first()->id,
            'amount'       => $this->faker->randomDigit(3),
            'created_at'  => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
