<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OrderService
{
    public function sendOrderToApi($orderId, $email, $name)
    {
        // Ganti URL_API dengan endpoint API tujuan
        $response = Http::timeout(2)->post('http://127.0.0.1:8001/api/orders', [
            'order_id' => $orderId,
            'email' => $email,
            'name' => $name,
        ]);
        // Bisa tambahkan logika penanganan response jika perlu
        return $response->successful();
    }
} 