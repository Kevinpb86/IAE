<?php

namespace App\Http\Controllers;

use App\Models\PurchaseHistory;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        // Get statistics
        $totalPurchases = PurchaseHistory::count();
        $completedPurchases = PurchaseHistory::where('status', 'completed')->count();
        $pendingPurchases = PurchaseHistory::where('status', 'pending')->count();
        $totalRevenue = PurchaseHistory::where('status', 'completed')->sum('amount');

        // Get paginated results with items count
        $purchases = $query->withCount('items')->latest()->paginate(10);


        if ($request->ajax()) {
            return response()->json([
                'purchases' => $purchases,
                'statistics' => [
                    'totalPurchases' => $totalPurchases,
                    'completedPurchases' => $completedPurchases,
                    'pendingPurchases' => $pendingPurchases,
                    'totalRevenue' => $totalRevenue
                ],
                'view' => view('partials.purchase-history-table', compact('purchases', 'totalPurchases', 'completedPurchases', 'pendingPurchases', 'totalRevenue'))->render()
            ]);
        }

        return view('history', compact('purchases', 'totalPurchases', 'completedPurchases', 'pendingPurchases', 'totalRevenue'));
    }

    // New API method for filtering purchase history
    public function filterApi(Request $request)
    {
        $query = PurchaseHistory::query()->with('items'); // Eager load items

        // Apply filters based on request parameters
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_method') && $request->payment_method !== '') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Add more filters here as needed, e.g., by amount range, customer ID, etc.

        // Optional: Handle search similar to index method if needed for this API endpoint
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Optional: Pagination
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $purchases = $request->has('paginate') && $request->paginate == 'false' 
                     ? $query->get()
                     : $query->paginate($perPage);

        return response()->json($purchases);
    }

    // New API method to receive and store purchase history from User project
    public function store(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|string|unique:purchase_histories',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:completed,pending,cancelled',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Error', 'errors' => $validator->errors()], 400);
        }

        // Create the purchase history record
        $purchaseHistory = PurchaseHistory::create([
            'order_id' => $request->order_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'amount' => $request->amount,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Create purchase items
        foreach ($request->items as $item) {
            $purchaseHistory->items()->create([ // Assuming a hasMany relationship named 'items'
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Purchase history stored successfully', 'purchase' => $purchaseHistory], 201);
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

    public function print($id)
    {
        $purchase = PurchaseHistory::with('items')->findOrFail($id);
        return view('purchase.print', compact('purchase'));
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
