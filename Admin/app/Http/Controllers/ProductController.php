<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_gender' => 'required|string|in:male,female',
            'product_category' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'required|array|min:1',
        ]);

        // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            // Get the file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            
            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $extension;
            
            // Store the file in the public/Product directory
            $request->file('product_image')->move(public_path('Product'), $filename);
            
            // Save the relative path to the database
            $imagePath = 'Product/' . $filename;
        }

        // Create the product
        $product = Product::create([
            'product_name' => $validated['product_name'],
            'gender' => $validated['product_gender'],
            'category' => $validated['product_category'],
            'price' => $validated['product_price'],
            'stock' => $validated['product_stock'],
            'size' => implode(',', $validated['sizes']), // Store sizes as comma-separated string
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Retrieve all products.
     */
    public function getProducts()
    {

    }
}
