<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        // These should be moved to .env file
        $this->baseUrl = env('EAI_ADMIN_API_URL', 'http://localhost:8000/api');
        $this->apiKey = env('EAI_ADMIN_API_KEY', 'databaseadmin123');
    }

    public function getAllProducts()
    {
        try {
            $response = Http::withHeaders([
                'X-API-TOKEN' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/products');

            if ($response->successful()) {
                return $response->json();
            }

            \Log::error('API Error: ' . $response->body());
            return [];
        } catch (\Exception $e) {
            \Log::error('Error fetching products from API: ' . $e->getMessage());
            return [];
        }
    }

    public function getProductById($id)
    {
        try {
            $response = Http::withHeaders([
                'X-API-TOKEN' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/products/' . $id);

            if ($response->successful()) {
                return $response->json();
            }

            \Log::error('API Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            \Log::error('Error fetching product from API: ' . $e->getMessage());
            return null;
        }
    }
} 