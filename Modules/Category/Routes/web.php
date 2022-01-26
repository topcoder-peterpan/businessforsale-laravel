<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Category\Http\Controllers\SubCategoryController;

Route::prefix('admin')->middleware(['auth:super_admin', 'setlang'])->group(function () {
    // Category Routes
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('module.category.index');
        Route::get('/add', [CategoryController::class, 'create'])->name('module.category.create');
        Route::post('/add', [CategoryController::class, 'store'])->name('module.category.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('module.category.edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('module.category.update');
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('module.category.destroy');
        Route::post('/category/update/order', [CategoryController::class, 'updateOrder'])->name('module.category.updateOrder');
    });

    // subCategory Routes
    Route::prefix('subcategory')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('module.subcategory.index');
        Route::get('/add', [SubCategoryController::class, 'create'])->name('module.subcategory.create');
        Route::post('/add', [SubCategoryController::class, 'store'])->name('module.subcategory.store');
        Route::get('/edit/{subcategory}', [SubCategoryController::class, 'edit'])->name('module.subcategory.edit');
        Route::put('/update/{subcategory}', [SubCategoryController::class, 'update'])->name('module.subcategory.update');
        Route::delete('/destroy/{subcategory}', [SubCategoryController::class, 'destroy'])->name('module.subcategory.destroy');
    });
});
Route::get('/get-sub-categories/{category_id}', [CategoryController::class, 'getSubcategories']);
