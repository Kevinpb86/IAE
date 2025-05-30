<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        
        // Calculate totals
        $subtotal = collect($cartItems)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
        
        $shipping = $subtotal > 0 ? 10 : 0; // Example shipping cost
        $tax = $subtotal * 0.1; // Example 10% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
        ]);

        $cart = session('cart', []);
        
        // Check if product already exists in cart
        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity']++;
        } else {
            $cart[$product['id']] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => 1
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully');
    }
} 