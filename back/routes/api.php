<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Actions\Auth\Logout;
use App\Actions\Product\Index as ProductIndex;

Route::middleware(['auth:api'])->prefix('/auth')->group(function(){
    Route::get('me', [UserController::class,'me']);
    Route::post('logout', Logout::class);
});
Route::get('products', ProductIndex::class);
