<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    /**
     * Get all products
     */
    public function __construct()
    {
        // Base URL for the API
        $this->baseUrl = 'http://127.0.0.1:8001/api/products';
    }
    
    public function getAllProducts($filters = [])
    {
        try {
            $query = Product::query();

            // Apply filters
            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (isset($filters['category'])) {
                $query->where('category', 'like', '%' . $filters['category'] . '%');
            }

            if (isset($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('description', 'like', '%' . $filters['search'] . '%');
                });
            }

            // Sorting
            $sortBy = $filters['sort_by'] ?? 'created_at';
            $sortOrder = $filters['sort_order'] ?? 'desc';
            $query->orderBy($sortBy, $sortOrder);

            // Pagination
            $perPage = $filters['per_page'] ?? 15;
            $products = $query->paginate($perPage);

            return [
                'success' => true,
                'data' => $products,
                'message' => 'Products retrieved successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Error getting products: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to retrieve products',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get single product by ID
     */
    public function getProductById($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return [
                    'success' => false,
                    'message' => 'Product not found'
                ];
            }

            return [
                'success' => true,
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Error getting product: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to retrieve product',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create new product
     */
    public function createProduct($data)
    {
        try {
            // Validate data
            $validator = $this->validateProductData($data);
            
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ];
            }

            // Generate SKU if not provided
            if (!isset($data['sku']) || empty($data['sku'])) {
                $data['sku'] = $this->generateSku($data['name']);
            }

            // Set default status
            $data['status'] = $data['status'] ?? true;

            // Create product
            $product = Product::create($data);

            return [
                'success' => true,
                'data' => $product,
                'message' => 'Product created successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Update product
     */
    public function updateProduct($id, $data)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return [
                    'success' => false,
                    'message' => 'Product not found'
                ];
            }

            // Validate data
            $validator = $this->validateProductData($data, $id);
            
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ];
            }

            // Update product
            $product->update($data);

            return [
                'success' => true,
                'data' => $product->fresh(),
                'message' => 'Product updated successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete product
     */
    public function deleteProduct($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return [
                    'success' => false,
                    'message' => 'Product not found'
                ];
            }

            $product->delete();

            return [
                'success' => true,
                'message' => 'Product deleted successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Validate product data
     */
    private function validateProductData($data, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            'sku' => 'nullable|string|max:100|unique:products,sku' . ($id ? ",$id" : ''),
            'weight' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean'
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Generate SKU from product name
     */
    private function generateSku($name)
    {
        $sku = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 6));
        $sku .= rand(1000, 9999);
        
        // Check if SKU exists
        while (Product::where('sku', $sku)->exists()) {
            $sku = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 6));
            $sku .= rand(1000, 9999);
        }
        
        return $sku;
    }
}