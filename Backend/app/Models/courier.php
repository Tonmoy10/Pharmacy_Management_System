<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courier extends Model
{
    use HasFactory;
    protected $table='courier';
    public $timestamps = false;

    public function accepted_order()
    {
        return $this->hasMany(accepted_order::class,'courier_id','courier_id');
    }

    public function users()
    {
        return $this->belongsTo(users::class,'courier_id','u_id');
    }
}
