<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WaiterController extends BaseController
{

    public function generateCode(){
        $restaurant = Restaurant::find(request()->restaurantId);
        $branchName = request()->branchName;
        $table = request()->table;
        $token = Str::random(32);
        DB::table('tokens')->insert(
            ['token' => $token]
        );
        return view('waiter',compact('restaurant','branchName','table','token'));
    }

}
