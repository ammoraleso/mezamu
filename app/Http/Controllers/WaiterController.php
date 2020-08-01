<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WaiterController extends BaseController
{

    public function generateCode(){
        $table = request()->table;
        $token = Str::random(32);
        DB::table('tokens')->insert(
            ['token' => $token]
        );
        $uriRestaurant = $this->generate_url();
        return view('home',compact('table','token','uriRestaurant'));
    }

    public function generate_url()
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
        
        return $scheme.'://'.$server_name.$port.'/';
    }

}
