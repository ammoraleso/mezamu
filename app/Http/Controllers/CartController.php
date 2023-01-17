<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishBranch;
use App\Models\Customer;
use App\Models\Token;
use App\Utils\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart = null;

    public function showCart()
    {
        $paymentType = Session::get('paymentType');
        return view('cart', compact('paymentType'));
    }

    /*This method is called by ajax*/
    public function addItem(){

        $this->cart = Session::get('cart');//get the cart stored in session to add quantities of a same product.
        $totalQuantity = Session::get('totalQuantity') ? Session::get('totalQuantity') : 0;

        $quantity = request('quantity');
        $itemID = request('itemID');
        $item = Dish::find($itemID);
        $banchID = request('branchID');
        $dishBranch = DishBranch::where('branch_id', '=',$banchID)->where('dish_id', '=', $itemID)->get()->first();

        if($this->cart){
            if(array_key_exists($item->id, $this->cart)) {
                Arr::set($this->cart, $item->id . '.quantity', Arr::get($this->cart, $item->id . '.quantity') + $quantity);
            }else{
                $this->cart = Arr::add($this->cart, $item->id, ['item' => $dishBranch, 'quantity' => $quantity]);
            }
        }else{
            $this->cart = [$item->id => ['item' => $dishBranch, 'quantity' => $quantity]];
        }
        $totalQuantity += $quantity;
        Session::put('totalQuantity', $totalQuantity);
        Session::put('cart', $this->cart);
        Session::save();
        return  $totalQuantity;//Needed to reload the cart icon*/
    }

    /**
     * Remove completely the item
     * @return totalQuantity to know if should fade out the cart or just a item of the cart
     */
    public function removeItem(){
        $itemID = request('itemID');
        if($itemID) {
            $this->cart = Session::get('cart');//get the cart stored in session to add quantities of a same product.
            if ($this->cart && array_key_exists($itemID, $this->cart)) {
                $totalQuantity = Session::get('totalQuantity')- Arr::get($this->cart, $itemID.'.quantity');
                if($totalQuantity == 0){
                    Session::forget('cart');
                }else {
                    Arr::forget($this->cart, $itemID);
                    Session::put('cart', $this->cart);
                }
                Session::put('totalQuantity', $totalQuantity);
                Session::save();
                return  $totalQuantity;//Needed to reload the cart icon
            }
        }
    }

    /*This method is called by ajax*/
    public function changeQuantity(){
        $itemID = request('itemID');
        $newQuantity = request('quantity');
        if($itemID) {
            $this->cart = Session::get('cart');//get the cart stored in session to add quantities of a same product.
            if ($this->cart && array_key_exists($itemID, $this->cart)) {
                $oldQuantity = Arr::get($this->cart, $itemID.'.quantity');
                Arr::set($this->cart, $itemID.'.quantity', $newQuantity);
                $oldTotalQuantity = Session::get('totalQuantity');
                Session::put('totalQuantity',$oldTotalQuantity + $newQuantity - $oldQuantity);
                Session::put('cart', $this->cart);
                Session::save();
            }
        }
    }

    public function findEmail(){
        $email = request()->email;
        return $customer = Customer::where('email', '=',$email)->get()->first();
    }

    public function uploadCustomer(){
        Session::put('customer', $this->saveCustomer());
    }

    public function saveCustomer(){

        $nombre = request()->name;
        $telefono = request()->phone;
        $direccion = request()->address;
        $email = request()->email;
        $aditional_address = request()->aditional_address;

        return Customer::updateOrCreate(['email' => $email],['nombre' => $nombre,'direccion' => $direccion, 'direccion_adicional' => $aditional_address,'telefono' => $telefono]);
    }

    public function checkOut(){
        // TODO CHANGE IN SITU TO PAYMENT TYPE
        $habitacion = "1";
       NotificationController::notify('in-situ','Habitación '.$habitacion,request()->total,request()->description);
    }

    public function checkOutDelivery(){
        $address = request()->address;
        $total = request()->total;
        $description = request()->description;
        $disableEpay = request()->disable_epay;
        NotificationController::notify('delivery',$address, $total,$description,$disableEpay);
    }

}
