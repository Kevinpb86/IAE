<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;



// Public Routes
Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/shop', function () {
    return view('shop.index'); // Pastikan view ini ada, atau sesuaikan dengan kebutuhan
})->name('shop');

// Cart Route
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/layouts', function () {
        return view('layouts.layouts');
    })->name('layouts');
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

