<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('/inputdata', function () {
    return view('inputdata');
});

Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/queue', function () {
    return view('queue');
});

Route::get('/history', [PurchaseHistoryController::class, 'index'])->name('history.index');
Route::get('/history/{id}', [PurchaseHistoryController::class, 'show'])->name('history.show');
Route::get('/history/{id}/download', [PurchaseHistoryController::class, 'download'])->name('history.download');


Route::get('/purchase-history', [PurchaseHistoryController::class, 'index'])->name('purchase.history');
Route::get('/purchase-history/{id}', [PurchaseHistoryController::class, 'show'])->name('purchase.show');
Route::get('/purchase-history/{id}/download', [PurchaseHistoryController::class, 'download'])->name('purchase.download');
Route::get('/purchase-history/{id}/print', [PurchaseHistoryController::class, 'print'])->name('purchase.print');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

