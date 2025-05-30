<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'image_url',
        'sku',
        'weight',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'weight' => 'decimal:2',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Scope for active products
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for products with stock
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        return $this->stock > 0;
    }

    /**
     * Check if product is active
     */
    public function isActive()
    {
        return $this->status == true;
    }
}