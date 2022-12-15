<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supply_cart extends Model
{
    use HasFactory;
    protected $table='supply_cart';
    public $timestamps = false;

    public function supply()
    {
        return $this->hasMany(supply::class,'cart_id','cart_id');
    }

    public function contract()
    {
        return $this->hasMany(contract::class,'cart_id','cart_id');
    }

    public function manager()
    {
        return $this->belongsTo(manager::class,'manager_id','manager_id');
    }
}
