<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserApiController;

// Contoh endpoint API user service
Route::middleware('api')->get('/user/ping', function (Request $request) {
    return response()->json(['message' => 'UserService aktif']);
});

Route::middleware('api')->get('/user/{id}', [UserApiController::class, 'getUserById']);
Route::middleware('api')->get('/products', [UserApiController::class, 'getProductsFromProductService']);

// Tambahkan endpoint lain sesuai kebutuhan 