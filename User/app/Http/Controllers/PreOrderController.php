<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

        // Here you would typically save the pre-order to the database
        // For now, we'll just redirect back with a success message
        return redirect()->back()->with('success', 'Pre-order submitted successfully!');
    }
} 