<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingTransaction extends Model
{
    protected $fillable = [
        'transaction_id',
    ];

    public function transaction(){
        return $this->belongsTo(PaymentTransactions::class, 'transaction_id', 'id');
    }
}
