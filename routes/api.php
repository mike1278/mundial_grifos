<?php

use App\Actions\Product\Index as ProductIndex;
use Illuminate\Support\Facades\Route;

Route::get('/products', ProductIndex::class);
