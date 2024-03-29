<?php


namespace App\Http\Controllers;


use App\Models\OrderDish;
use App\Notifications\Order;
use App\Utils\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    public static function notify(String $type, $place, $total, $description, $disableEpay = "1"){
        $order = new \App\Models\Order();
        $order->branch_id = Arr::first(Session::get('cart'))['item']->branch->id;
        $order->type = $type;
        $order->place = $place;
        $order->total = $total;
        $order->annotations = $description;
        $total = 0;
        if($type === 'delivery'){
            if($disableEpay === "1"){
                $order->payment_type = 'efectivo';
            }else{
                $order->payment_type = 'ecommerce';
            }
            Session::put('deliveryPrice', Arr::first(Session::get('cart'))['item']->branch->delivery_price);
        }else{
            $order->payment_type = $type;
        }
        $order->save();

        $items = array_values(Session::get('cart'));
        forEach($items as $item){
            $orderDish = new OrderDish();
            $orderDish->order_id = $order->id;
            $orderDish->dish_branch_id = $item['item']->id;
            $orderDish->quantity = $item['quantity'];
            $orderDish->delivered = 0;
            $orderDish->save();
        }
        Arr::first(Session::get('cart'))['item']->branch->notify(new Order($order));
        Session::put('finalOrder', Session::get('cart'));
        Session::put('finalPrice', $order->total);
        Session::put('finaltotalQuantity', Session::get('totalQuantity'));
        Utils::cleanCart();
    }
}
