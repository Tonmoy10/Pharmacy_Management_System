<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table='users';
    public $timestamps = false;
    protected $primaryKey= 'u_id';

    public function vendor()
    {
        return $this->hasMany(vendor::class,'u_id','u_id');
    }

    public function customer()
    {
        return $this->hasMany(customer::class,'u_id','u_id');
    }

    public function courier()
    {
        return $this->hasMany(courier::class,'u_id','u_id');
    }

    public function manager()
    {
        return $this->hasMany(manager::class,'u_id','u_id');
    }
}
