<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;
    protected $table='carts';
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(order::class,'cart_id','cart_id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class,'customer_id','customer_id');
    }

    public function medicine()
    {
        return $this->hasMany(medicine::class,'med_id','med_id');
    }

    public function orders_cart()
    {
        return $this->hasMany(orders_cart::class,'cart_id','cart_id');

    }
}
