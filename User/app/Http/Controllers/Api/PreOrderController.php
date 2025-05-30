<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        // Simpan data ke database
        $preOrder = PreOrder::create($validated);

        // Periksa apakah request menginginkan respons JSON (API call)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Pre-order berhasil disimpan',
                'data' => $preOrder,
            ], 201);
        }

        // Jika berasal dari form web, redirect ke halaman lain
        return redirect()->route('preorder.form')->with('success', 'Pre-order berhasil disimpan!');
    }

    public function index()
    {
        // Ambil semua data pre-order dari database
        $preOrders = PreOrder::all();

        // Kembalikan data dalam format JSON
        return response()->json($preOrders);
    }

    public function show($id)
    {
        // Cari pre-order berdasarkan ID
        $preOrder = PreOrder::find($id);

        // Jika pre-order tidak ditemukan, kembalikan respons error
        if (!$preOrder) {
            return response()->json(['message' => 'Pre-order tidak ditemukan'], 404);
        }

        // Kembalikan data pre-order
        return response()->json($preOrder);
    }
}