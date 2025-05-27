<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'quantity',
        'address',
        'phone_number',
        'email',
        'additional_notes',
    ];
}