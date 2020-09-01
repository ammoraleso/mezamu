<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function uploadOrder(){

        $order = request()->order;
        Order::where('id',  $order["id"])->update(['status' =>  $order["status"]]);

    }
}
