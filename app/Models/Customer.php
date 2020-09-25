<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    
    protected $fillable = ['email','nombre','direccion','direccion_adicional','telefono'];
}