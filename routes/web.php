<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/', [DashboardController::class])->name('dashboard');
});
