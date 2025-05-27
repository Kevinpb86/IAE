<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
    // Contoh: Mendapatkan data user berdasarkan ID
    public function getUserById($id)
    {
        // Dummy response, ganti dengan logic sesuai kebutuhan
        return response()->json([
            'id' => $id,
            'name' => 'User ' . $id,
            'email' => 'user' . $id . '@example.com',
        ]);
    }

    // Contoh: Mendapatkan daftar produk dari ProductService (Admin)
    public function getProductsFromProductService()
    {
        // Ganti URL berikut dengan URL API ProductService (Admin) yang sebenarnya
        $response = Http::get('http://localhost:8001/api/products');
        return $response->json();
    }
} 