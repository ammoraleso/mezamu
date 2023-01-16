<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Branch extends Model
{
    use Notifiable;

    public function dishes(){
        return $this->hasManyThrough(Dish::class,DishBranch::class,'branch_id','id','id','dish_id');
    }

    public function ScheduleBranch(){
        return $this->hasMany(ScheduleBranch::class);
    }

    public function PaymentType(){
        return $this->hasMany(PaymentType::class);
    }


    public function branchDishes(){
        return $this->hasMany(DishBranch::class)->where('disable','=', 0);
    }

    public function branchDishesAdmin(){
        return $this->hasMany(DishBranch::class);
    }

    public function getDishBranch($branch_id, $dish_id) {
        return $this->branchDishes()->where('branch_id','=', $branch_id)->where('dish_id','=',$dish_id)->get();
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
