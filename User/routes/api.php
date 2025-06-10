<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PreOrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderApiController;

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



/*
|--------------------------------------------------------------------------
| API Routes for User Service (Port 8001)
|--------------------------------------------------------------------------
*/

Route::middleware(['api'])->group(function () {
    
    // Product API Routes
    Route::prefix('products')->group(function () {
        // GET /api/products - Get all products with filters
        Route::get('/', [ProductController::class, 'index']);
        // POST /api/products - Create new product
        Route::post('/', [ProductController::class, 'store']);
        // GET /api/products/stats - Get products statistics
        Route::get('/stats', [ProductController::class, 'stats']);
        // GET /api/products/{id} - Get single product
        Route::get('/{id}', [ProductController::class, 'show']);
        // PUT /api/products/{id} - Update product (full update)
        Route::put('/{id}', [ProductController::class, 'update']);
        // PATCH /api/products/{id} - Update product (partial update)
        Route::patch('/{id}', [ProductController::class, 'update']);
        // DELETE /api/products/{id} - Delete product
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    // Order API Routes
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/orders', [OrderApiController::class, 'index']);
});