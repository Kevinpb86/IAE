<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\PurchaseHistoryController;

Route::middleware(['api'])->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/products', [ProductApiController::class, 'store']);
    
    // Purchase History API routes
    Route::get('/purchase-history', [PurchaseHistoryController::class, 'filterApi']);
    Route::post('/purchase-history', [PurchaseHistoryController::class, 'store']);

    Route::get('/test-api', function () {
        return response()->json(['message' => 'API is working']);
    });
});
