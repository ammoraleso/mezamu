<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show(){
        if (Auth::check()){
            $orders = [];
            foreach (Order::where('branch_id',Auth::user()->branch_id)->where('status', '<', '3')->get() as $order){
                array_push($orders, ['order' => $order, 'items' => $order->items()->get()]);
            }
            return view('/home', compact('orders'));
        }
        return view('welcome');
    }

}
