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
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'item_name' => 'required|string|max:255',
            'item_quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:20',
            'total_price' => 'required|numeric|min:0',
            'additional_notes' => 'nullable|string|max:1000',
        ]);


        $validated['user_id'] = auth()->id();

        $preOrder = PreOrder::create($validated);

        return redirect()->back()->with('success', 'Pre-order submitted successfully!');
    }

    public function index()
    {
        $preOrders = PreOrder::where('user_id', auth()->id())->get();
        return view('preorder.index', compact('preOrders'));
    }
} 

    