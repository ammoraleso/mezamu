<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{

    public function show(Restaurant $restaurant, $branchName){
        $branch = $restaurant->branches()->where('location',$branchName)->first();
        if(is_null($branch)){
            abort(404);
        }
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        $branchDishes = $branch->branchDishes;
        return view('menu', compact('branchDishes', 'categories'));
    }

    public function sort_objects_by_id($a, $b) {
        if($a->id == $b->id){ return 0 ; }
        return ($a->id < $b->id) ? -1 : 1;
    }

    public function loadCategories($dishes){
        $categories = array();
        foreach ($dishes as $dish) {
            array_push($categories, $dish->category);
        }
        $categories = array_unique($categories);
        usort($categories, array($this,'sort_objects_by_id'));
        return $categories;
    }
}
