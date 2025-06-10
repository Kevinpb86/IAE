<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    // protected $connection = 'user';
    // protected $table = 'pre_orders';

    protected $fillable = [
        'user_id',
        'product',
        'quantity',
        'customer_name',
        'customer_email',
        'item_name',
        'item_quantity',
        'total_price',
        'address',
        'phone_number',
        'additional_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}