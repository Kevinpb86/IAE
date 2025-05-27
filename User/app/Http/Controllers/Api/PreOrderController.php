<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PreOrderService;
use Illuminate\Support\Facades\Http;

class PreOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'additional_notes' => 'nullable|string',
        ]);

        // Mapping data
        $data = [
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'product_id' => $this->getProductIdByName($request->product), // Example mapping
            'quantity' => $request->quantity,
            'notes' => $request->additional_notes,
            'address' => $request->address,
            'phone' => $request->phone_number,
            'email' => $request->email,
        ];

        $preOrder = PreOrderService::addPreOrder($data);

        return response()->json($preOrder, 201);
    }

    public function index()
    {
        return response()->json(PreOrderService::getAllPreOrders());
    }

    // Helper function to get product ID by name
    private function getProductIdByName($productName)
    {
        // Example: Replace this with actual logic to fetch product ID
        $product = \App\Models\Product::where('name', $productName)->first();
        return $product ? $product->id : null;
    }
}