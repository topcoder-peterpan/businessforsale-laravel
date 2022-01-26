<?php

use Illuminate\Support\Facades\Route;
use Modules\Tag\Http\Controllers\TagController;

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
    // Tag Routes
    Route::prefix('tag')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('module.tag.index');
        Route::get('/add', [TagController::class, 'create'])->name('module.tag.create');
        Route::post('/add', [TagController::class, 'store'])->name('module.tag.store');
        Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('module.tag.edit');
        Route::put('/update/{tag}', [TagController::class, 'update'])->name('module.tag.update');
        Route::delete('/destroy/{tag}', [TagController::class, 'destroy'])->name('module.tag.destroy');
        Route::delete('/tag/multiple/destroy', [TagController::class, 'multipleDestroy'])->name('module.tag.multiple.destroy');
    });
});
