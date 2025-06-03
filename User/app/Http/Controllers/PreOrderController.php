<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PreOrder;

class PreOrderController extends Controller
{
    public function showForm()
    {
        $products = Product::all();
        return view('preorder.form', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'notes' => 'nullable|string'
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create the pre-order
        $preOrder = PreOrder::create($validated);

        return redirect()->back()->with('success', 'Pre-order submitted successfully!');
    }

    public function index()
    {
        // Get only the current user's pre-orders
        $preOrders = PreOrder::where('user_id', auth()->id())->get();
        return view('preorder.index', compact('preOrders'));
    }
} 