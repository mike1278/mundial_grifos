<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Actions\Product\Index as ProductIndex;
use App\Actions\Product\Show as ProductShow;
use App\Actions\Category\Index as CategoryIndex;

Route::middleware(['auth', 'verified', 'role:admin|superAdmin'])->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/{product}', ProductShow::class)
        ->whereNumber('product')->name('products.show');
    Route::resource('products', ProductController::class)->except(['index','show']);

    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::resource('categories', CategoryController::class)->except(['index','show']);
});

Route::fallback(FallBackController::class);
