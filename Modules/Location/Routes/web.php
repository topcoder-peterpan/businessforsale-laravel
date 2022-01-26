<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controllers\CityController;
use Modules\Location\Http\Controllers\TownController;

Route::middleware(['auth:super_admin', 'setlang'])->group(function () {
    // City CRUD
    Route::prefix('admin/city')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('module.city.index');
        Route::get('create', [CityController::class, 'create'])->name('module.city.create');
        Route::post('store', [CityController::class, 'store'])->name('module.city.store');
        Route::get('edit/{city}', [CityController::class, 'edit'])->name('module.city.edit');
        Route::put('update/{city}', [CityController::class, 'update'])->name('module.city.update');
        Route::delete('delete/{city}', [CityController::class, 'destroy'])->name('module.city.delete');
    });

    // Town CRUD
    Route::prefix('admin/town')->group(function () {
        Route::get('/', [TownController::class, 'index'])->name('module.town.index');
        Route::get('create', [TownController::class, 'create'])->name('module.town.create');
        Route::post('store', [TownController::class, 'store'])->name('module.town.store');
        Route::get('edit/{town}', [TownController::class, 'edit'])->name('module.town.edit');
        Route::put('update/{town}', [TownController::class, 'update'])->name('module.town.update');
        Route::delete('delete/{town}', [TownController::class, 'destroy'])->name('module.town.delete');
    });
});

Route::get('/get-towns/{city_id}', [CityController::class, 'getTowns']);
