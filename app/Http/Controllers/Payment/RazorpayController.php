<?php

namespace App\Http\Controllers\Payment;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class RazorpayController extends Controller
{
    use PaymentTrait;

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $payment->capture(array('amount' => $payment['amount']));

                $plan = Plan::findOrFail($request->plan_id);
                $this->userPlanInfoUpdate($plan);
                $this->createTransaction($request->razorpay_payment_id, 'Razorpay', $request->amount, $request->plan_id);
                $user = auth('customer')->user();
                $user->notify(new MembershipUpgradeNotification($user, $plan->label));
                storePlanInformation();

                session()->flash('success', 'Payment Successfully');
                return redirect()->route('frontend.plans-billing');
            } catch (\Exception $e) {
                return $e->getMessage();
                session()->put('error', $e->getMessage());
                return redirect()->back();
            }
        }
    }
}
