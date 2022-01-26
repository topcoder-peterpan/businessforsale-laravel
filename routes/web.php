<?php

use Illuminate\Support\Facades\Route;

// ====================Artisan command======================
Route::get('route-clear', function () {
    \Artisan::call('route:clear');
    dd("Route Cleared");
});
Route::get('optimize', function () {
    \Artisan::call('optimize');
    dd("Optimized");
});
Route::get('view-clear', function () {
    \Artisan::call('view:clear');
    dd("View Cleared");
});
Route::get('view-cache', function () {
    \Artisan::call('view:cache');
    dd("View cleared and cached again");
});
Route::get('config-cache', function () {
    \Artisan::call('config:cache');
    dd("configuration cleared and cached again");
});


Route::get('/test', function () {
    return $blog_enable;
    // return $blog_enable;
    // return enableModule('newsletter');

    if (enableModule('newsletter')) {
        return 'thik ase';
        # code...
    } else {

        return 'thik nai';
    }
});
