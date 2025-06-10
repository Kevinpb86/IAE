<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PreOrderController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('User PreOrder API: Raw request body', ['body' => $request->getContent()]);

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

        \Log::info('PreOrder store: Validated data received', $validated);

        try {
            \Log::info('PreOrder store: Attempting to create PreOrder');
            $preOrder = PreOrder::create($validated);
            \Log::info('PreOrder store: PreOrder created successfully', ['id' => $preOrder->id]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'message' => 'Pre-order berhasil disimpan',
                    'data' => $preOrder,
                ], 201);
            }

            return redirect()->route('preorder.form')->with('success', 'Pre-order berhasil disimpan!');

        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error creating pre-order: ' . $e->getMessage());

            // Return a JSON error response if it's an API request
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'error' => 'Could not save pre-order',
                    'details' => $e->getMessage()
                ], 500);
            }

            // Otherwise, redirect back with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Could not save pre-order. Please try again.']);
        }
    }

    public function index()
    {
        $preOrders = PreOrder::all();

        return response()->json($preOrders);
    }

    public function show($id)
    {
        $preOrder = PreOrder::find($id);

        if (!$preOrder) {
            return response()->json(['message' => 'Pre-order tidak ditemukan'], 404);
        }

        return response()->json($preOrder);
    }
}