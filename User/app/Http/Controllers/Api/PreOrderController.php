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
        $data = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'notes' => 'nullable|string',
        ]);
        $preOrder = PreOrderService::addPreOrder($data);

        return response()->json($preOrder, 201);
    }

    public function index()
    {
        return response()->json(PreOrderService::getAllPreOrders());
    }
}