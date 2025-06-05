<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        return view('checkout', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $cartItems = session('cart', []);
        // Contoh data customer, sesuaikan dengan implementasi user
        $customer = auth()->user();
        $orderId = uniqid('ORD-');
        $email = $customer ? $customer->email : $request->input('email');
        $name = $customer ? $customer->name : $request->input('name');

        // Kirim ke service
        $orderService = new OrderService();
        $orderService->sendOrderToApi($orderId, $email, $name);

        // Simpan order, kosongkan cart, dsb.
        // Redirect ke halaman welcome dengan pesan sukses
        return redirect()->route('welcome')->with('success', 'Payment was successful!');
    }
}
