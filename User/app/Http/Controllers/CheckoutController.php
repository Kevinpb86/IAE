<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\Client\ConnectionException;
use App\Models\Order; // Tambahkan ini

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
        // Debug: log cartItems
        \Log::info('CheckoutController - cartItems:', $cartItems);

        // Contoh data customer, sesuaikan dengan implementasi user
        $customer = auth()->user();
        $orderId = uniqid('ORD-');
        $email = $customer ? $customer->email : $request->input('email');
        $name = $customer ? $customer->name : $request->input('name');

        // Simpan order ke database lokal
        $order = Order::create([
            'order_id' => $orderId,
            'email' => $email,
            'name' => $name,
            'products' => json_encode($cartItems), // Pastikan kolom 'products' ada di tabel orders
            'payment_method' => $paymentMethod,
        ]);

        // Kirim ke service
        try {
            $orderService = new OrderService();
            $result = $orderService->sendOrderToApi($orderId, $email, $name, $cartItems);
            \Log::info('OrderService API result:', ['result' => $result]);
        } catch (ConnectionException $e) {
            // Log the exception, but continue as successful
            \Log::error('Panggilan API OrderService gagal karena timeout: ' . $e->getMessage());
        }

        // Simpan order, kosongkan cart, dsb.
        session()->forget('cart'); // Clear the cart
        return redirect()->route('home')->with('success', 'Payment was successful!');
    }
}
