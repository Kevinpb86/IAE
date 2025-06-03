<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\AdminProduct;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Get cart items for the current user
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->product_id,
                    'name' => $item->product->product_name,
                    'price' => $item->price,
                    'image_url' => $item->product->image ? asset($item->product->image) : 'https://via.placeholder.com/100',
                    'quantity' => $item->quantity
                ];
            });
        
        // Calculate totals
        $subtotal = $cartItems->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
        
        $shipping = $subtotal > 0 ? 10 : 0; // Example shipping cost
        $tax = $subtotal * 0.1; // Example 10% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:admin.products,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
        ]);

        // Check if product already exists in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $validated['id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['id'],
                'price' => $validated['price'],
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart successfully');
    }

    public function updateQuantity(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Ensure the cart item belongs to the current user
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cart->update($validated);

        return response()->json([
            'message' => 'Cart updated successfully',
            'cart' => $cart
        ]);
    }

    public function removeFromCart(Cart $cart)
    {
        // Ensure the cart item belongs to the current user
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Item removed from cart successfully'
        ]);
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'message' => 'Cart cleared successfully'
        ]);
    }
} 