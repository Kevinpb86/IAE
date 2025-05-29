<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = AdminProduct::all()->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'image_url' => $product->image ? asset('Product/' . basename($product->image)) : 'https://via.placeholder.com/300x400',
                'category' => $product->category,
                'gender' => $product->gender,
                'size' => $product->size,
                'stock' => $product->stock,
                'created_at' => $product->created_at
            ];
        });
        
        return view('shop', [
            'products' => $products
        ]);
    }
} 