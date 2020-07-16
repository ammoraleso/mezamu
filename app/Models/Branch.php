<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    public function dishes(){
        return $this->hasManyThrough(Dish::class,DishBranch::class,'branch_id','id','id','dish_id');
    }
}
