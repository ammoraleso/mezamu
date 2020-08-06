<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ScheduleBranch extends Model
{
    protected $table = 'schedule_branch';

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

}
