<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    //We need "with" property and dishBranch method (with the same name) in order to eager fetch relation and pass it to notification
    protected $with = ['dishBranch'];

    public function dishBranch(){
        return $this->hasOne(DishBranch::class,'id','dish_branch_id');
    }
}
