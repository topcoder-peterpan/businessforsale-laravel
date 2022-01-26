<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CmsSettingController;
use App\Http\Controllers\Payment\SettingController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;

Route::prefix('admin')->middleware(['auth:super_admin', 'setlang'])->group(function () {
    Route::redirect('/', 'dashboard', 301);

    //Dashboard Route
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('home');

    //Profile Route
    Route::get('/profile/settings', [ProfileController::class, 'setting'])->name('profile.setting');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'profile_update'])->name('profile.update');
    Route::put('/profile/password/{id}', [ProfileController::class, 'profile_password_update'])->name('profile.password.update');

    //Roles Route
    Route::resource('role', RolesController::class);

    //Users Route
    Route::resource('user', UserController::class);

    //====================Setting==============================
    Route::get('settings/{page}', [SettingsController::class, 'index'])->name('setting.index');
    Route::put('settings/{page}', [SettingsController::class, 'update'])->name('setting');
    Route::post('test/mail-send', [SettingsController::class, 'testMailSend'])->name('send.test.mail');

    //====================Social Setting==============================
    Route::put('/social/{provider}/settings', [SocialLoginController::class, 'dataUpdate'])->name('admin.socialsetting.update');

    // ==================== Skin System =====================
    Route::get('/skins', [ThemeController::class, 'index'])->name('module.themes.index');
    Route::put('/skins', [ThemeController::class, 'update'])->name('module.themes');

    // ==================== Payment Setting =====================
    Route::put('paypalesetting', [SettingController::class, 'paypalUpdate'])->name('admin.paypalsetting');
    Route::put('paystacksetting', [SettingController::class, 'paystackUpdate'])->name('admin.paystacksetting');
    Route::put('stripesetting', [SettingController::class, 'stripeUpdate'])->name('admin.stripesetting');
    Route::put('razorpaysetting', [SettingController::class, 'razorpayUpdate'])->name('admin.razorpaysetting');
    Route::put('sslcommerzsetting', [SettingController::class, 'sslcommerzUpdate'])->name('admin.sslcommerzsetting');

    //====================Website SEO Setting==============================
    Route::put('/seo', [SettingsController::class, 'updateSeo'])->name('admin.seo.update');

    //====================Website CMS Setting==============================
    Route::put('/posting-rules', [CmsSettingController::class, 'postingRulesUpdate'])->name('admin.posting.rules.update');
    Route::put('/about', [CmsSettingController::class, 'updateAbout'])->name('admin.about.update');
    Route::put('/terms', [CmsSettingController::class, 'updateTerms'])->name('admin.terms.update');
    Route::put('/privacy', [CmsSettingController::class, 'updatePrivacy'])->name('admin.privacy.update');
    Route::put('/home', [CmsSettingController::class, 'updateHome'])->name('admin.home.update');
    Route::put('/get-membership', [CmsSettingController::class, 'updateGetMembership'])->name('admin.getmembership.update');
    Route::put('/pricing-plan', [CmsSettingController::class, 'updatePricingPlan'])->name('admin.pricingplan.update');
    Route::put('/faq', [CmsSettingController::class, 'updateFaq'])->name('admin.faq.update');
    Route::put('/dashboard', [CmsSettingController::class, 'updateDashboard'])->name('admin.dashboard.update');
    Route::put('/blog', [CmsSettingController::class, 'updateBlog'])->name('admin.blog.update');
    Route::put('/ads', [CmsSettingController::class, 'updateAds'])->name('admin.ads.update');
    Route::put('/contact', [CmsSettingController::class, 'updateContact'])->name('admin.contact.update');
});

// Admin Reset Password
Route::prefix('admin')->middleware(['setlang'])->group(function () {
    Route::get('forgot/password', [ForgotPasswordController::class, 'adminResetPasswordForm'])->name('admin.forgot.password');
    Route::post('admin/password/mail', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    Route::get('password-reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('admin-password-update', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
});
