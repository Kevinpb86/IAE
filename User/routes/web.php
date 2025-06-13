<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/preorder/form', [PreOrderController::class, 'showForm'])->name('preorder.form');
Route::post('/preorder/store', [PreOrderController::class, 'store'])->name('preorder.store');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Pre-order Routes
Route::get('/preorder/form', [PreOrderController::class, 'showForm'])->name('preorder.form');
Route::post('/preorder/store', [PreOrderController::class, 'store'])->name('preorder.store');

// Shop Route
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Cart Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{cart}/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clearCart'])->name('cart.clear');
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/api/orders/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Checkout Route (proses checkout harus login)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Order Routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/email/{email}', [OrderController::class, 'getOrdersByEmail'])->name('orders.by-email');
Route::get('/orders/date-range', [OrderController::class, 'getOrdersByDateRange'])->name('orders.by-date-range');

// Protected Routes (hanya fitur yang perlu login)
Route::middleware(['auth'])->group(function () {
    Route::get('/layouts', function () {
        return view('layouts.layouts');
    })->name('layouts');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
});

