<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:admin|superAdmin'])->group(function(){
    Route::inertia('/', 'Dashboard')->name('dashboard');
    Route::post('/image', [FileController::class,'store'])->name('files.store');

    Route::resource('clients', ClientController::class)->whereNumber('client');
    Route::resource('products', ProductController::class)->whereNumber('product');
    Route::resource('colors', ColorController::class)->whereNumber('color');
    Route::resource('models', ModelController::class)->whereNumber('model');
    Route::resource('brands', BrandController::class)->whereNumber('brand');
    Route::resource('categories', CategoryController::class)->whereNumber('category');
    Route::resource('orders', CategoryController::class)->whereNumber('order');
});

Route::fallback(FallBackController::class);
