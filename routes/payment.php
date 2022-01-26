<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;

//Paypal
// Route::get('paypal/payment', [PayPalController::class, 'createTransaction'])->name('paypal.payment');
Route::post('paypal/payment', [PayPalController::class, 'processTransaction'])->name('paypal.post');
Route::get('success-transaction/{plan_id}/{amount}', [PayPalController::class, 'successTransaction'])->name('paypal.successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('paypal.cancelTransaction');

// Stripe
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// Razorpay
Route::post('payment', [RazorpayController::class, 'payment'])->name('razorpay.post');

// Paystack
Route::post('paystack/payment', [PaystackController::class, 'redirectToGateway'])->name('paystack.post');
Route::get('/paystack/success', [PaystackController::class, 'successPaystack'])->name('paystack.success');

// SSLCOMMERZ
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
