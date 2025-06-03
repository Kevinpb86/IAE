<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product',
        'quantity',
        'address',
        'phone_number',
        'email',
        'additional_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}