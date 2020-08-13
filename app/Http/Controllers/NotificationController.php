<?php


namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\OrderDish;
use App\Notifications\Order;
use App\Utils\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    public static function notify(String $type, $place, $total){
        $order = new \App\Models\Order();
        $order->type = $type;
        $order->place = $place;
        $order->total = $total;
        //$total = Session::get('totalPrice');
        $total = 0;
        if($type === 'delivery'){
            $order->payment_type = 'ecommerce';
            $order->customer_id = Session::get('customer')->id;
        }else{
            $order->payment_type = 'in-situ';
        }
        $order->save();

        $items = array_values(Session::get('cart'));
        forEach($items as $item){
            $orderDish = new OrderDish();
            $orderDish->order_id = $order->id;
            $orderDish->dish_branch_id = $item['item']->id;
            $orderDish->quantity = $item['quantity'];
            $orderDish->save();
        }
        Arr::first(Session::get('cart'))['item']->branch->notify(new Order($order));
        Utils::cleanCart();
    }
}
