<?php

namespace App\Services;

use App\Models\PreOrder;

class PreOrderService
{
    public static function addPreOrder($data)
    {
        return PreOrder::create($data);
    }

    public static function getAllPreOrders()
    {
        return PreOrder::all();
    }
}