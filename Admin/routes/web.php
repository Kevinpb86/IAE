<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/inputdata', function () {
    return view('inputdata');
});

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
