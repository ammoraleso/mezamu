<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_type';

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

}
