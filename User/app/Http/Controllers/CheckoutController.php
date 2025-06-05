<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Validasi dan proses pembayaran sesuai metode
        // Simpan order, kosongkan cart, dsb.
        return redirect()->route('cart')->with('success', 'Pembayaran berhasil!');
    }
}
