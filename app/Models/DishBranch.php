<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class DishBranch extends Model
{
    protected $table = 'dish_branch';

    public function dish(){
        return $this->hasOne(Dish::class,'id','dish_id');
    }

    public function discountPercentage(){
        if (!is_null($this->promotion_percentage) and $this->promotion_percentage != 0){
            return $this->promotion_percentage;
        }elseif (!is_null($this->promotion_price) and $this->promotion_price != 0){
            return 100-($this->promotion_price*100/$this->dish->price);
        }
        throw new Exception('Wrong data for promotion');
    }

    public function discountPrice(){
        if (!is_null($this->promotion_percentage) and $this->promotion_percentage != 0){
            return floor($this->dish->price*(100-$this->promotion_percentage)/100);
        }elseif (!is_null($this->promotion_price) and $this->promotion_price != 0){
            return $this->promotion_price;
        }
        throw new Exception('Wrong data for promotion');
    }

}
