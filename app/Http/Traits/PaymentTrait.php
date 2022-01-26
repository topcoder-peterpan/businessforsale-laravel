<?php

namespace App\Http\Traits;

use App\Models\UserPlan;
use App\Models\Transaction;

trait PaymentTrait
{
    /**
     * Update userplan information.
     *
     * @param Plan $plan
     * @return boolean
     */
    public function userPlanInfoUpdate($plan)
    {
        $userplan = UserPlan::customerData()->first();
        $userplan->ad_limit = $userplan->ad_limit + $plan->ad_limit;
        $userplan->featured_limit = $userplan->featured_limit + $plan->featured_limit;
        if (!$userplan->customer_support) {
            $userplan->customer_support = $plan->customer_support ? true : false;
        }
        if (!$userplan->badge) {
            $userplan->badge = $plan->badge ? true : false;
        }
        $userplan->save();

        return true;
    }

    /**
     * Create a new transaction instance.
     *
     * @param string $payment_id
     * @param string $payment_type
     * @param int $payment_amount
     * @param int $plan_id
     *
     * @return boolean
     */
    public function createTransaction(string $payment_id, string $payment_type, int $payment_amount, int $plan_id)
    {
        Transaction::create([
            'payment_id' => $payment_id,
            'customer_id' => auth('customer')->id(),
            'plan_id' => $plan_id,
            'payment_type' => $payment_type,
            'amount' => $payment_amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
