<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Actions\Auth\Logout;

Route::middleware(['auth:api'])->group(function(){
    Route::post('/orders/products/{product}', [OrderProductController::class, 'store']);
    Route::put('/orders/products/{product}', [OrderProductController::class, 'update']);
    Route::delete('/orders/products/{product}', [OrderProductController::class, 'destroy']);
    Route::prefix('/auth')->group(function(){
        Route::get('me', [UserController::class,'me']);
        Route::get('register', [ClientController::class,'store']);
        Route::post('logout', Logout::class);
    });
});
//Route::get('products', ProductIndex::class);
