<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

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
    // Post Routes
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('module.post.index');
        Route::get('/add', [BlogController::class, 'create'])->name('module.post.create');
        Route::post('/add', [BlogController::class, 'store'])->name('module.post.store');
        Route::get('/edit/{post}', [BlogController::class, 'edit'])->name('module.post.edit');
        Route::put('/update/{post}', [BlogController::class, 'update'])->name('module.post.update');
        Route::delete('/destroy/{post}', [BlogController::class, 'destroy'])->name('module.post.destroy');
    });
});
