<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

Route::middleware('api')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/products', [ProductApiController::class, 'store']);
    
    Route::get('/test-api', function () {
        return response()->json(['message' => 'API is working']);
    });
});
