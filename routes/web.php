<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Actions\Product\Index as ProductIndex;

Route::middleware(['auth', 'verified', 'role:admin|superAdmin'])->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::resource('products', ProductController::class)->except('index');
});

Route::fallback(FallBackController::class);
