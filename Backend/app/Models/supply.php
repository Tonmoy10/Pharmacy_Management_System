<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supply extends Model
{
    use HasFactory;
    protected $table='supply';

    public $timestamps=false;


    public function supply_cart()
    {
        return $this->belongsTo(supply_cart::class,'cart_id','cart_id');
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class,'vendor_id','vendor_id');
    }
}
