<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accepted_order extends Model
{
    use HasFactory;
    protected $table='accepted_order';
    public $timestamps = false;
    public function orders()
    {
        return $this->belongsTo(orders::class,'order_id','order_id');
    }

    public function courier()
    {
        return $this->belongsTo(courier::class,'courier_id','courier_id');
    }
}
