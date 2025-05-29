<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    // GET /api/products
    public function index()
    {
        $filePath = storage_path('app/products.json');

        if (!file_exists($filePath)) {
            return response()->json([]);
        }

        $products = json_decode(file_get_contents($filePath), true);

        // Transform the data to match the expected format in the shop view
        $transformedProducts = array_map(function($product) {
            return [
                'id' => $product['id'],
                'name' => $product['product_name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'] ?? 'https://via.placeholder.com/300x400',
                'category' => $product['category'],
                'gender' => $product['gender'],
                'size' => $product['size'],
                'stock' => $product['stock'],
                'created_at' => $product['created_at']
            ];
        }, $products);

        return response()->json($transformedProducts);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required|string',
            'category' => 'required|string',
            'gender' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|string',
        ]);

        $filePath = storage_path('app/products.json');

        $products = [];
        if (file_exists($filePath)) {
            $products = json_decode(file_get_contents($filePath), true);
        }

        // Add timestamp and ID
        $data['id'] = time(); // simple unique ID
        $data['created_at'] = now()->toDateTimeString();

        $products[] = $data;

        file_put_contents($filePath, json_encode($products, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => true,
            'message' => 'Product saved successfully',
            'data' => $data,
        ], 201);
    }
}
