<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Utils\Utils;
use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{

    public function show(Restaurant $restaurant, $branchName)
    {
        $branch = Utils::verifyBranch($restaurant, $branchName);
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        $branchDishes = $branch->branchDishes;
        $allowAdd = false;
        return view('menu', compact('branchDishes', 'categories', 'allowAdd'));
    }

    public function menuWithToken(Restaurant $restaurant, $branchName, $table, $token){
        $branch = Utils::verifyBranch($restaurant, $branchName);
        if(!Utils::isTokenValid($token)){
            return view('invalidToken');
        }
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        $branchDishes = $branch->branchDishes;
        $allowAdd = true;
        return view('menu', compact('branchDishes', 'categories', 'allowAdd'));
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
