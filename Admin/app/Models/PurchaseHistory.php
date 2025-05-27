<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_email',
        'amount',
        'status',
        'notes',
        'payment_method'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function getItemsCountAttribute()
    {
        return $this->items()->count();
    }
}
