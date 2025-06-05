<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|unique:orders,order_id',
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        $order = Order::create($validated);

        return response()->json([
            'success' => true,
            'order' => $order
        ], 201);
    }

    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
}
