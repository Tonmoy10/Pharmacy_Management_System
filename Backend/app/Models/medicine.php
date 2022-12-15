<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicine extends Model
{
    use HasFactory;
    protected $table='medicine';
    public $timestamps = false;

    public function carts()
    {
        return $this->belongsTo(carts::class,'cart_id','cart_id');
    }

    public function contract()
    {
        return $this->belongsTo(contract::class,'contract_id','contract_id');
     }
    
}
