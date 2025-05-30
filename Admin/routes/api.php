<?php

use App\Http\Controllers\API\ProductApiController;

Route::post('/products', [ProductApiController::class, 'store']);
