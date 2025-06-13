<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Services\OrderService;
use Illuminate\Http\Client\ConnectionException;
use App\Models\Order; // Tambahkan ini

class CheckoutController extends Controller
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

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
        $cartItems = session('cart', []);
        return view('checkout', compact('cartItems'));

    }

    public function process(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'card_number' => 'required|string|max:19',
            'expiry' => 'required|string|max:5',
            'cvv' => 'required|string|max:3',
        ]);

        try {
            DB::beginTransaction();

            // Get cart items
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            
            if ($cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty');
            }

            // Calculate total
            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            $shipping = 10;
            $tax = $subtotal * 0.1;
            $total = $subtotal + $shipping + $tax;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => [
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'postal_code' => $validated['postal_code'],
                    'phone' => $validated['phone'],
                ],
                'payment_status' => 'pending',
                'payment_method' => 'credit_card'
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            // Clear the cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'data' => [
                    'order_number' => $order->order_number
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 

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

