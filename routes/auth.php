<?php

use App\Http\Controllers\Auth\Customer\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialLoginController;

//====================Frontent Authentication=========================
// registration proccess
Route::get('/sign-up', [FrontendController::class, 'signUp'])->name('frontend.signup');
Route::post('customer/register', [FrontendController::class, 'register'])->name('customer.register');

// login proccess
Route::post('/customer/login', [App\Http\Controllers\Auth\Customer\LoginController::class, 'login'])->name('frontend.login')->middleware('auth_logout');
Route::post('/frontend/logout', [FrontendController::class, 'frontendLogout'])->name('frontend.logout');

// Customer Reset Password
Route::get('forgot/password', [ForgotPasswordController::class, 'customerResetPasswordForm'])->name('customer.forgot.password');
Route::post('customer/password/mail', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::get('password-reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');
Route::post('customer-password-update', [ResetPasswordController::class, 'reset'])->name('customer.password.update');

Auth::routes(['login' => false]);

// Social Authentication
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');

Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');


//Auth Guard Logout
Route::post('auth-logout', function (Request $request) {
    if ($request->auth === 'customer') {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
})->name('auth.logout');

Route::get('login', [App\Http\Controllers\Auth\Customer\LoginController::class, 'showLoginForm'])->name('customer.login');
Route::get('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('admin.login')->middleware('setlang');
Route::post('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login')->middleware('auth_logout');
