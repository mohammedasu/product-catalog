<?php

use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:60,1'])->prefix('v1')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('categories', [CategoryController::class, 'index']);
});