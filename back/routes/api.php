<?php

use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Actions\Auth\Logout;
use App\Actions\Product\Index as ProductIndex;

Route::middleware(['auth:api'])->prefix('/auth')->group(function(){
    Route::get('me', [UserController::class,'me']);
    Route::post('/orders/products/{product}', [OrderProductController::class, 'store']);
    Route::put('/orders/products/{product}', [OrderProductController::class, 'update']);
    Route::delete('/orders/products/{product}', [OrderProductController::class, 'destroy']);
    Route::post('logout', Logout::class);
});
//Route::get('products', ProductIndex::class);
