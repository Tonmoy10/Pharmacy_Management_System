<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_otp extends Model
{
    use HasFactory;
    
    protected $table='users_otp';
    public $timestamps=false;
}
