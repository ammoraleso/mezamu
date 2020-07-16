<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{

    public function show(Branch $branch){
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        return view('menu', compact('dishes', 'categories'));
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
