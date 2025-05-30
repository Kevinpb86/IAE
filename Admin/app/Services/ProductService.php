<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Ambil semua produk
     */
    public function getAllProducts()
    {
        return Product::all();
    }

    /**
     * Buat produk baru
     */
    public function createProduct(array $data)
    {
        // Pastikan hanya field yang diizinkan yang dikirim
        Log::info('Data for product creation:', $data);
        return Product::create([
            'product_name' => $data['product_name'],
            'category'     => $data['category'],
            'gender'       => $data['gender'],
            'size'         => $data['size'],
            'price'        => $data['price'],
            'stock'        => $data['stock'],
        ]);
    }
}
