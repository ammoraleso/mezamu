<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'ref_payco','response_code','response_reason','data', 'cart', 'delivery_name', 'city', 'address', 'status',
    ];
}
