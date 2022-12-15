<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class vendor extends Model
{
    use HasFactory;
    protected $table='vendors';
    public $timestamps = false;

    public function supply()
    {
        return $this->hasMany(supply::class,'vendor_id','vendor_id');
    }

    public function contract()
    {
        return $this->hasMany(contract::class,'vendor_id','vendor_id');
    }

    public function users()
    {
        return $this->belongsTo(users::class,'u_id','u_id');
    }
}

