<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{product}', 'show');
        Route::put('/{product}', 'update');
        Route::delete('/{product}', 'destroy');
    });

    Route::controller(ServiceController::class)->prefix('services')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{service}', 'show');
        Route::put('/{service}', 'update');
        Route::delete('/{service}', 'destroy');
    });
});
