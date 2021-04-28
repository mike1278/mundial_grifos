<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:admin|superAdmin'])->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/image', [FileController::class,'store'])->name('files.store');

    Route::resource('clients', ClientController::class)->whereNumber('client');
    Route::resource('products', ProductController::class)->whereNumber('product');
    Route::resource('options', OptionController::class)->whereNumber('option');
    Route::resource('categories', CategoryController::class)->whereNumber('category');
});

Route::fallback(FallBackController::class);
