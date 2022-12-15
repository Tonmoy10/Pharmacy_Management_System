<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    use HasFactory;
    protected $table='manager';
    public $timestamps = false;

    public function supply_cart()
    {
        return $this->hasOne(supply_cart::class,'manager_id','manager_id');
    }

    public function users()
    {
        return $this->belongsTo(users::class,'manager_id','u_id');
    }
}
