<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;

class PreOrderController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function form()
    {
        $response = Http::get('http://localhost:8001/api/products');
        $products = $response->json();

        return view('preorder.form', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        // Fetch product details from the database
        $product = $this->productService->getProductById($validated['product_id']);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Store pre-order
        $preOrder = PreOrder::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Pre-order successfully stored',
                'data' => $preOrder,
            ], 201);
        }

        return redirect()->route('preorder.form')->with('success', 'Pre-order successfully stored!');
    }
}