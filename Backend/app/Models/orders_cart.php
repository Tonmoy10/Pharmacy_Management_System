<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_cart extends Model
{
    use HasFactory;
    protected $table='orders_cart';
    public $timestamps=false;

    public function carts()
    {
        return $this->belongsTo(carts::class,'cart_id','cart_id');
    }

    public function order()
    {
        return $this->belongsTo(order::class,'order_id','order_id');
    }
}
