<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\Client\ConnectionException;

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
        try {
            $orderService = new OrderService();
            $orderService->sendOrderToApi($orderId, $email, $name);
        } catch (ConnectionException $e) {
            // Log the exception, but continue as successful
            \Log::error('Panggilan API OrderService gagal karena timeout: ' . $e->getMessage());
        }

        // Simpan order, kosongkan cart, dsb.
        session()->forget('cart'); // Clear the cart
        return redirect()->route('home')->with('success', 'Payment was successful!');
    }
}
