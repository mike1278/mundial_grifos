<?php

use App\Actions\DB\Backup;
use App\Actions\DB\Restore;
use App\Actions\GenerateSession;
use App\Actions\Statistics;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::get('/front/auth/{token}', GenerateSession::class);

Route::middleware(['auth', 'verified', 'role:admin|root'])->group(function(){
    Route::get('/', Statistics::class)->name('dashboard');
    Route::get('/backups/create', Backup::class)->name('backups.create');
    Route::get('/backups', Restore::class)->name('backups.index');

    Route::post('/image', [FileController::class,'store'])->name('files.store');
    Route::post('/restore', Restore::class)->name('restore');

    Route::resource('clients', ClientController::class)->whereNumber('client');
    Route::resource('currencies', CurrencyController::class)->whereNumber('currency');
    Route::resource('currencies.rates', RateController::class)->whereNumber('rate');
    Route::resource('products', ProductController::class)->whereNumber('product');
    Route::resource('colors', ColorController::class)->whereNumber('color');
    Route::resource('models', ModelController::class)->whereNumber('model');
    Route::resource('brands', BrandController::class)->whereNumber('brand');
    Route::resource('categories', CategoryController::class)->whereNumber('category');
    Route::resource('orders', OrderController::class)->whereNumber('order');
});


Route::fallback(FallBackController::class);
