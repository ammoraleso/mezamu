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
        return view('home',compact('table','token'));
    }

}
