<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProduct extends Model
{
    protected $connection = 'admin';
    protected $table = 'products';
    
    protected $fillable = [
        'product_name',
        'category',
        'gender',
        'size',
        'price',
        'stock',
        'image',
    ];
} 