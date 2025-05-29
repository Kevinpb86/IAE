<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductService
{
    public function index(ProductService $productService)
    {
        $products = $productService->fetchProducts();
        return view('products.index', compact('products'));
    }
    
}

