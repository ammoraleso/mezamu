<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Utils\Utils;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\DishBranch;
use App\Models\Dish;
use Illuminate\Http\Request;

$finalOrder = null;
$finalPrice = null;
$finaltotalQuantity = null;

class successfulPurchaseController extends BaseController
{
    public function show()
    {
        $finalOrder = Session::get('finalOrder');
        $finalPrice = Session::get('finalPrice');
        $finaltotalQuantity = Session::get('finaltotalQuantity');
        $deliveryPrice =  Session::get('deliveryPrice');
        
        return view('successfulPurchase',compact('finalOrder','finalPrice', 'finaltotalQuantity','deliveryPrice'));
    }

}
