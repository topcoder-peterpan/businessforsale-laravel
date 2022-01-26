<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $paymentSetting;

    public function __construct()
    {
        $this->paymentSetting = PaymentSetting::first();
    }

    public function paypalUpdate(Request $request)
    {
        if ($request->paypal) {
            $request->validate([
                'paypal_client_id' => 'required',
                'paypal_client_secret' => 'required',
            ]);
        }

        if ($request->paypal_live_mode) {
            envReplace('PAYPAL_MODE', 'live');
            envReplace('PAYPAL_LIVE_CLIENT_ID', $request->paypal_client_id);
            envReplace('PAYPAL_LIVE_CLIENT_SECRET', $request->paypal_client_secret);
        } else {
            envReplace('PAYPAL_MODE', 'sandbox');
            envReplace('PAYPAL_SANDBOX_CLIENT_ID', $request->paypal_client_id);
            envReplace('PAYPAL_SANDBOX_CLIENT_SECRET', $request->paypal_client_secret);
        }

        $this->paymentSetting->update([
            'paypal_live_mode' => $request->paypal_live_mode ? true : false,
            'paypal' => $request->paypal ? true : false,
        ]);

        flashSuccess('Paypal Setting Updated Successfully');
        return back();
    }

    public function stripeUpdate(Request $request)
    {
        if ($request->stripe) {
            $request->validate([
                'stripe_client_id' => 'required',
                'stripe_client_secret' => 'required',
            ]);
        }

        envReplace('STRIPE_KEY', $request->stripe_client_id);
        envReplace('STRIPE_SECRET', $request->stripe_client_secret);
        $this->paymentSetting->update(['stripe' => $request->stripe ? true : false]);

        flashSuccess('Stripe Setting Updated Successfully');
        return back();
    }

    public function razorpayUpdate(Request $request)
    {
        if ($request->razorpay) {
            $request->validate([
                'razorpay_client_id' => 'required',
                'razorpay_client_secret' => 'required',
            ]);
        }

        envReplace('RAZORPAY_KEY', $request->razorpay_client_id);
        envReplace('RAZORPAY_SECRET', $request->razorpay_client_secret);
        $this->paymentSetting->update(['razorpay' => $request->razorpay ? true : false]);

        flashSuccess('RazorPay Setting Updated Successfully');
        return back();
    }

    public function sslcommerzUpdate(Request $request)
    {
        if ($request->ssl_commerz) {
            $request->validate([
                'ssl_client_id' => 'required',
                'ssl_client_secret' => 'required',
            ]);
        }

        envReplace('STORE_ID', $request->ssl_client_id);
        envReplace('STORE_PASSWORD', $request->ssl_client_secret);
        $this->paymentSetting->update(['ssl_commerz' => $request->ssl_commerz ? true : false]);

        flashSuccess('SSl Commerz Setting Updated Successfully');
        return back();
    }

    public function paystackUpdate(Request $request)
    {
        if ($request->paystack) {
            $request->validate([
                'paystack_client_id' => 'required',
                'paystack_client_secret' => 'required',
                'merchant_email' => 'required',
            ]);
        }

        envReplace('PAYSTACK_PUBLIC_KEY', $request->paystack_client_id);
        envReplace('PAYSTACK_SECRET_KEY', $request->paystack_client_secret);
        envReplace('MERCHANT_EMAIL', $request->merchant_email);
        $this->paymentSetting->update(['paystack' => $request->paystack ? true : false]);

        flashSuccess('Paystack Setting Updated Successfully');
        return back();
    }
}
