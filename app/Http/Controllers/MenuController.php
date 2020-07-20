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

    public function loadCategories($dishes){
        $categories = array();
        foreach ($dishes as $dish) {
            array_push($categories, $dish->category);
        }
        $categories = array_unique($categories);
        return $categories;
    }

}
