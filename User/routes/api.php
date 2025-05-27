<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PreOrderController;

// Rute untuk User
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
});

// Rute untuk PreOrder
Route::prefix('preorders')->group(function () {
    Route::post('/', [PreOrderController::class, 'store']);
    Route::get('/', [PreOrderController::class, 'index']);
    Route::get('/{id}', [PreOrderController::class, 'show']);
});
