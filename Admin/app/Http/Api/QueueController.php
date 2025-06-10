<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreOrder;
use Illuminate\Support\Facades\Http;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8001/api/preorders');
        return response()->json($response->json());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'item_name' => 'required|string|max:255',
            'item_quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        // Generate order ID
        $orderId = '#ORD-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        // Get customer initials from name
        $initials = implode('', array_map(function($word) {
            return strtoupper(substr($word, 0, 1));
        }, explode(' ', $validated['customer_name'])));

        $response = Http::post('http://127.0.0.1:8001/api/preorders', array_merge($validated, [
            'order_id' => $orderId,
            'customer_initials' => $initials,
        ]));

        return response()->json($response->json(), $response->status());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get('http://127.0.0.1:8001/api/preorders/' . $id);
        if ($response->status() === 404) {
            return response()->json(['message' => 'Pre-order not found'], 404);
        }
        return response()->json($response->json());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        $response = Http::put('http://127.0.0.1:8001/api/preorders/' . $id, $validated);
        if ($response->status() === 404) {
            return response()->json(['message' => 'Pre-order not found'], 404);
        }
        return response()->json($response->json());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('http://127.0.0.1:8001/api/preorders/' . $id);
        if ($response->status() === 404) {
            return response()->json(['message' => 'Pre-order not found'], 404);
        }
        return response()->json(null, $response->status());
    }
} 