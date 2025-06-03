<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of products
     * GET /api/products
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Get filters from request
            $filters = [
                'status' => $request->get('status'),
                'category' => $request->get('category'),
                'search' => $request->get('search'),
                'sort_by' => $request->get('sort_by', 'created_at'),
                'sort_order' => $request->get('sort_order', 'desc'),
                'per_page' => $request->get('per_page', 15)
            ];

            $result = $this->productService->getAllProducts($filters);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => $result['data']->items(),
                    'pagination' => [
                        'current_page' => $result['data']->currentPage(),
                        'last_page' => $result['data']->lastPage(),
                        'per_page' => $result['data']->perPage(),
                        'total' => $result['data']->total(),
                        'from' => $result['data']->firstItem(),
                        'to' => $result['data']->lastItem()
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'error' => $result['error'] ?? null
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created product
     * POST /api/products
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $result = $this->productService->createProduct($data);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => $result['data']
                ], 201);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['errors'] ?? null
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product
     * GET /api/products/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $result = $this->productService->getProductById($id);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message']
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified product
     * PUT/PATCH /api/products/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = $request->all();
            $result = $this->productService->updateProduct($id, $data);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => $result['data']
                ], 200);
            }

            $statusCode = isset($result['errors']) ? 422 : 404;
            
            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['errors'] ?? null
            ], $statusCode);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified product
     * DELETE /api/products/{id}
     */
    public function destroy($id): JsonResponse
    {
        try {
            $result = $this->productService->deleteProduct($id);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message']
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products statistics
     * GET /api/products/stats
     */
    public function stats(): JsonResponse
    {
        try {
            $totalProducts = \App\Models\Product::count();
            $activeProducts = \App\Models\Product::where('status', true)->count();
            $inStockProducts = \App\Models\Product::where('stock', '>', 0)->count();
            $outOfStockProducts = \App\Models\Product::where('stock', 0)->count();

            return response()->json([
                'success' => true,
                'message' => 'Statistics retrieved successfully',
                'data' => [
                    'total_products' => $totalProducts,
                    'active_products' => $activeProducts,
                    'in_stock_products' => $inStockProducts,
                    'out_of_stock_products' => $outOfStockProducts,
                    'inactive_products' => $totalProducts - $activeProducts
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}