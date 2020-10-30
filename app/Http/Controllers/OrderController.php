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

    public function updateDelivered(){

        $orderDish = request()->orderDish;
        OrderDish::where('id',  $orderDish["id"])->update(['delivered' =>  $orderDish["delivered"]]);

    }

    public function loadOrders(){
        $date = request()->dateInput;
        $userLogged = auth()->user();
        $orders = [];
        if(!$date){
            return view('orders');
        }
        foreach ( Order::where('branch_id',$userLogged->branch_id)->where('created_at', 'like',"%".$date."%")->get() as $order){
            $order->date = $order->created_at->format('Y-m-d H:i:s');
            array_push($orders, ['order' => $order, 'items' => $order->items()->get()]);
        }
        return view('orders', compact('orders'));
    }
}
