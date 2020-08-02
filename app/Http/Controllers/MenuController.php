<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Utils\Utils;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class MenuController extends BaseController
{

    public function show(Restaurant $restaurant, $branchName)
    {
        $branch = Utils::verifyBranch($restaurant, $branchName);
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        $branchDishes = $branch->branchDishes;
        $allowAdd = false;
        return view('menu', compact('branchDishes', 'categories', 'allowAdd','restaurant'));
    }

    public function menuWithToken(Restaurant $restaurant, $branchName, $table, $token){
        $branch = Utils::verifyBranch($restaurant, $branchName);
        if(!Utils::isTokenValid($token)){
            return view('invalidToken');
        }
        $dishes = $branch->dishes;
        $categories = $this->loadCategories($dishes);
        $branchDishes = $branch->branchDishes;
        $urlMenu = $this->generate_url($restaurant->slug, $branchName, $table, $token);
        $allowAdd = true;
        Session::put('table', $table);
        Session::put('urlMenu', $urlMenu);
        Session::save();
        return view('menu', compact('branchDishes', 'categories', 'allowAdd', 'restaurant'));
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

    public function generate_url($restaurantName, $branchName, $table, $token)
    {
        $server_name = $_SERVER['SERVER_NAME'];

        if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
            $port = ":$_SERVER[SERVER_PORT]";
        } else {
            $port = '';
        }

        if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
            $scheme = 'https';
        } else {
            $scheme = 'http';
        }
        $uriRestaurant = '/'.$restaurantName.'/'.$branchName.'/'.$table.'/'.$token;
        return $scheme.'://'.$server_name.$port.$uriRestaurant;
    }
}
