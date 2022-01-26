<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->middleware(['auth:super_admin', 'setlang'])->group(function () {
    // Brand Routes
    Route::group(['as' => 'module.customer.', 'prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('/{customer}', 'CustomerController@show')->name('show');
    });
});
