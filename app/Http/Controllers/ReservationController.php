<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Utils\Utils;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class reservationController extends BaseController
{

    public function show(Restaurant $restaurant, $branchName)
    {
        $branch = Utils::verifyBranch($restaurant, $branchName);
        $urlMenu = $this->generate_url($restaurant->slug, $branchName);
        Session::put('urlMenu', $urlMenu);
        Session::save();
        return view('reservation', compact('restaurant'));
    }

    public function generate_url($restaurantName, $branchName)
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
        $uriRestaurant = '/'.$restaurantName.'/'.$branchName;
        return $scheme.'://'.$server_name.$port.$uriRestaurant;
    }
}
