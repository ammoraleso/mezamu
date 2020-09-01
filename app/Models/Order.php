<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['type','payment_type','customer_id','place','status','total'];
    
    public function items(){
        return $this->hasMany(OrderDish::class);
    }
}
