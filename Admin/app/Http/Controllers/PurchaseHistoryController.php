<?php

namespace App\Http\Controllers;

use App\Models\PurchaseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = PurchaseHistory::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Date filter
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Get paginated results
        $purchases = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'purchases' => $purchases,
                'view' => view('partials.purchase-history-table', compact('purchases'))->render()
            ]);
        }

        return view('history', compact('purchases'));
    }

    public function show($id)
    {
        $purchase = PurchaseHistory::findOrFail($id);
        return response()->json($purchase);
    }

    public function download($id)
    {
        $purchase = PurchaseHistory::findOrFail($id);
        
        // Generate PDF or CSV based on your needs
        // For now, we'll just return a JSON response
        return response()->json([
            'message' => 'Download functionality will be implemented here',
            'purchase' => $purchase
        ]);
    }

    // Helper method to generate a unique order ID
    private function generateOrderId()
    {
        $prefix = 'ORD';
        $timestamp = now()->format('YmdHis');
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        return $prefix . $timestamp . $random;
    }
}
