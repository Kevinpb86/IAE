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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'notes' => 'nullable|string'
        ]);

        // Here you would typically save the pre-order to the database
        // For now, we'll just redirect back with a success message
        return redirect()->back()->with('success', 'Pre-order submitted successfully!');
    }
} 