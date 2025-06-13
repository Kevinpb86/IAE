<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['order_id', 'email', 'name', 'items', 'products']; // Add 'products' column

    /**
     * Fetch orders for a specific user by email.
     *
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUserOrders($email)
    {
        return self::where('email', $email)->orderBy('created_at', 'desc')->get();
    }
}
