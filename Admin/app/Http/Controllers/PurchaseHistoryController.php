<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Get base query
        $query = Order::query()->select('order_id', 'email', 'name', 'products'); // Include 'products'

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Get paginated orders
        $orders = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'orders' => $orders,
                'view' => view('partials.purchase-history-table', [
                    'orders' => $orders
                ])->render()
            ]);
        }

        return view('history', [
            'orders' => $orders
        ]);
    }

    /**
     * Get the appropriate status badge class for an order status
     */
    private function getStatusBadgeClass($status)
    {
        $classes = [
            'completed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];

        return $classes[$status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Show a single order's details
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        
        $orderData = [
            'id' => $order->id,
            'order_id' => $order->order_id,
            'customer' => [
                'name' => $order->name,
                'email' => $order->email
            ],
            'products' => json_decode($order->products, true), // Include 'products'
            'status' => $order->status,
            'total_amount' => $order->total_amount,
            'payment_method' => $order->payment_method,
            'shipping_address' => $order->shipping_address,
            'notes' => $order->notes,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
            'status_badge' => $this->getStatusBadgeClass($order->status)
        ];

        return response()->json($orderData);
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order->update([
            'status' => $validated['status']
        ]);

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => [
                'id' => $order->id,
                'status' => $order->status,
                'status_badge' => $this->getStatusBadgeClass($order->status)
            ]
        ]);
    }

    /**
     * Cancel an order
     */
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->status !== 'pending') {
            return response()->json([
                'message' => 'Only pending orders can be cancelled'
            ], 422);
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'message' => 'Order cancelled successfully',
            'order' => [
                'id' => $order->id,
                'status' => $order->status,
                'status_badge' => $this->getStatusBadgeClass($order->status)
            ]
        ]);
    }

    /**
     * Download order details
     */
    public function download($id)
    {
        $order = Order::findOrFail($id);
        
        // TODO: Implement PDF or CSV generation
        return response()->json([
            'message' => 'Download functionality will be implemented here',
            'order' => $order
        ]);
    }

    /**
     * Print order details
     */
    public function print($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.print', compact('order'));
    }
}