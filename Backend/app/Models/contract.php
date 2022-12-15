<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    use HasFactory;
    protected $table='contract';
    public $timestamps = false;

    public function vendor()
    {
        return $this->belongsTo(vendor::class,'vendor_id','vendor_id');
    }

    public function medicine()
    {
        return $this->hasMany(medicine::class,'contract_id','contract_id');
    }

    public function supply_cart()
    {
        return $this->belongsTo(supply_cart::class,'cart_id','cart_id');
    }
   
}
