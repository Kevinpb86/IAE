<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import model Order
use Illuminate\Support\Facades\Auth; // Import Auth facade

class HistoryController extends Controller
{
    public function index()
    {
        $userEmail = Auth::user()->email; // Mengambil email dari pengguna yang sedang login

        // Mengambil data pesanan dari database menggunakan model Order
        $orders = Order::getUserOrders($userEmail);

        // Mengirim data pesanan ke view history.blade.php
        return view('history', compact('orders'));
    }
}
