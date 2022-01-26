<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MessangerController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Frontend\AdPostController;
use App\Http\Controllers\Frontend\DashboardController;

// show website pages
Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('about', [FrontendController::class, 'about'])->name('about');
    Route::get('faq', [FrontendController::class, 'faq'])->name('faq');
    Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
    Route::get('terms-conditions', [FrontendController::class, 'terms'])->name('terms');
    Route::get('get-membership', [FrontendController::class, 'getMembership'])->name('getmembership');
    Route::get('price-plan', [FrontendController::class, 'pricePlan'])->name('priceplan');
    Route::get('price-plan-details/{plan_label}', [FrontendController::class, 'pricePlanDetails'])->name('priceplanDetails');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('ad-list', [FrontendController::class, 'adList'])->name('adlist');
    Route::get('ad-list-search', [FilterController::class, 'search'])->name('adlist.search');
    Route::get('category/{slug}', [FilterController::class, 'adsByCategory'])->name('adlist.category.show');
    Route::get('/ad/details/{ad:slug}', [FrontendController::class, 'adDetails'])->name('addetails');
    Route::get('/ad/gallery-details/{ad:slug}', [FrontendController::class, 'adGalleryDetails'])->name('ad.gallery.details');
    Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('blog/{blog:slug}', [FrontendController::class, 'singleBlog'])->name('single.blog');
    Route::get('blog/comments/count/{post_id}', [FrontendController::class, 'commentsCount']);

    // customer dashboard
    Route::prefix('dashboard')->middleware('auth:customer')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Ad Create
        Route::prefix('post')->middleware('checkplan')->group(function () {
            Route::get('/', [AdPostController::class, 'postStep1'])->name('post');
            Route::post('/', [AdPostController::class, 'storePostStep1'])->name('post.store');
            Route::get('/step2', [AdPostController::class, 'postStep2'])->name('post.step2');
            Route::post('/step2', [AdPostController::class, 'storePostStep2'])->name('post.step2.store');
            Route::get('/step3', [AdPostController::class, 'postStep3'])->name('post.step3');
            Route::post('/step3', [AdPostController::class, 'storePostStep3'])->name('post.step3.store');
            Route::get('/step2/back/{slug?}', [AdPostController::class, 'postStep2Back'])->name('post.step2.back');
            Route::get('/step1/back/{slug?}', [AdPostController::class, 'postStep1Back'])->name('post.step1.back');
        });

        // Ad Edit
        Route::prefix('post')->middleware('checkplan')->group(function () {
            Route::get('/{ad:slug}', [AdPostController::class, 'editPostStep1'])->name('post.edit');
            Route::put('/{ad:slug}/update', [AdPostController::class, 'UpdatePostStep1'])->name('post.update');
            Route::get('/{ad:slug}/step2', [AdPostController::class, 'editPostStep2'])->name('post.edit.step2');
            Route::put('/step2/{ad:slug}/update', [AdPostController::class, 'updatePostStep2'])->name('post.step2.update');
            Route::get('/{ad:slug}/step3', [AdPostController::class, 'editPostStep3'])->name('post.edit.step3');
            Route::put('/step3/{ad:slug}/update', [AdPostController::class, 'updatePostStep3'])->name('post.step3.update');
            Route::get('/cancel/edit', [AdPostController::class, 'cancelAdPostEdit'])->name('post.cancel.edit');
        });

        // Messenger
        Route::get('message/{username?}', [MessangerController::class, 'index'])->name('message');
        Route::post('message/{username}', [MessangerController::class, 'sendMessage'])->name('message.store');

        Route::get('post-rules', [DashboardController::class, 'postRules'])->name('post.rules');
        Route::get('ad/{ad:slug}', [DashboardController::class, 'editAd'])->name('editad');
        Route::get('ads', [DashboardController::class, 'myAds'])->name('adds');
        Route::delete('delete-ads/{ad}', [DashboardController::class, 'deleteMyAd'])->name('delete.myad');
        Route::put('status-ads/{ad}', [DashboardController::class, 'myAdStatus'])->name('myad.status');
        Route::put('expire-ads/{ad}', [DashboardController::class, 'markExpired'])->name('myad.expire');
        Route::put('active-ad/{ad}', [DashboardController::class, 'markActive'])->name('myad.active');
        Route::get('favourites', [DashboardController::class, 'favourites'])->name('favourites');
        Route::get('plans-billing', [DashboardController::class, 'plansBilling'])->name('plans-billing');
        Route::get('account-setting', [DashboardController::class, 'accountSetting'])->name('account-setting');
        Route::put('profile', [DashboardController::class, 'profileUpdate'])->name('profile');
        Route::put('password', [DashboardController::class, 'passwordUpdate'])->name('password');
        Route::post('wishlist', [DashboardController::class, 'addToWishlist'])->name('add.wishlist');
        Route::delete('account-delete/{customer}', [DashboardController::class, 'deleteAccount'])->name('account.delete');
    });
});

Route::fallback(function () {
    abort(404);
});
