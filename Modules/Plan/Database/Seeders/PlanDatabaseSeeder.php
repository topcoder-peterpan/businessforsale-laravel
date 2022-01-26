<?php

namespace Modules\Plan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Plan\Entities\Plan;

class PlanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $plans = [
            [
                'label' => 'Basic',
                'price' => '10',
                'ad_limit' => '5',
                'featured_limit' => '2',
                'customer_support' => false,
                'badge' => false,
                'recommended' => false,
            ],
            [
                'label' => 'Standard',
                'price' => '20',
                'ad_limit' => '15',
                'featured_limit' => '5',
                'customer_support' => true,
                'badge' => true,
                'recommended' => true,
            ],
            [
                'label' => 'Premium',
                'price' => '50',
                'ad_limit' => '60',
                'featured_limit' => '20',
                'customer_support' => true,
                'badge' => true,
                'recommended' => false,
            ]
        ];

        Plan::insert($plans);
    }
}
