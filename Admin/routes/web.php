<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseHistoryController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/inputdata', function () {
    return view('inputdata');
});

Route::get('/history', [PurchaseHistoryController::class, 'index'])->name('history.index');
Route::get('/history/{id}', [PurchaseHistoryController::class, 'show'])->name('history.show');
Route::get('/history/{id}/download', [PurchaseHistoryController::class, 'download'])->name('history.download');

Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
Route::put('/update-settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
