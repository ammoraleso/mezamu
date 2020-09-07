<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['type','payment_type','customer_id','place','status','total'];

    //We need "with" property and customer method (with the same name) in order to eager fetch relation and pass it to notification
    protected $with = ['customer'];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    
    public function items(){
        return $this->hasMany(OrderDish::class);
    }
}
