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

        return response()->json($products);
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
        ]);

        $filePath = storage_path('app/products.json');

        $products = [];
        if (file_exists($filePath)) {
            $products = json_decode(file_get_contents($filePath), true);
        }

        // Tambahkan timestamp atau ID opsional
        $data['id'] = time(); // unik sederhana
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
