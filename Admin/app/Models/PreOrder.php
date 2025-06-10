<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class PreOrder
{
    public static function all()
    {
        $response = Http::get('http://127.0.0.1:8001/api/preorders');
        return $response->json();
    }
} 