<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // GET /api/products
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json(['products' => $products], 200);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'category'     => 'required|string',
            'gender'       => 'required|string|in:male,female,unisex',
            'size'         => 'required|string',
            'price'        => 'required|numeric',
            'stock'        => 'required|integer',
        ]);

        $product = $this->productService->createProduct($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }
}
