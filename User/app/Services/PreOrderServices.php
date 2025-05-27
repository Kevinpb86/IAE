<?php

namespace App\Services;

class PreOrderService
{
    protected static $preorders = [];

    public static function addPreOrder($data)
    {
        $id = count(self::$preorders) + 1;
        $data['id'] = $id;
        self::$preorders[] = $data;
        return $data;
    }

    public static function getAllPreOrders()
    {
        return self::$preorders;
    }
}