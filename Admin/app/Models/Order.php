<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'eai_user';
    protected $table = 'orders';
    
    protected $fillable = ['order_id', 'email', 'name'];
}
