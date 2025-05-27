<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/products');

        if ($response->successful()) {
            $products = $response->json();
            return view('products.index', compact('products'));
        }

        return view('products.index', ['products' => []])->withErrors('Failed to fetch products from Admin API.');
    }
}
