<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart = null;

    public function showCart()
    {
        return view('cart');
    }

    /*This method is called by ajax*/
    public function addItem(Item $item){
        $this->cart = Session::get('cart');//get the cart stored in session to add quantities of a same product.

        $quantity = request('quantity');

        if($this->cart){
            if(array_key_exists($item->id, $this->cart)) {
                Arr::set($this->cart, $item->id . '.quantity', Arr::get($this->cart, $item->id . '.quantity') + $quantity);
                Arr::set($this->cart, 'totalQuantity', Arr::get($this->cart, 'totalQuantity') + $quantity);
            }else{
                $this->cart = Arr::add($this->cart, $item->id, ['item' => $item, 'quantity' => $quantity]);
                Arr::set($this->cart, 'totalQuantity', Arr::get($this->cart, 'totalQuantity') + $quantity);
            }
        }else{
            $this->cart = [$item->id => ['item' => $item, 'quantity' => $quantity],
                            'totalQuantity' => $quantity];
        }
        Session::put('cart', $this->cart);
        Session::save();
        return  Arr::get(Session::get('cart'),'totalQuantity');//Needed to reload the cart icon*/
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
                $totalQuantity = Arr::get($this->cart, 'totalQuantity')- Arr::get($this->cart, $itemID.'.quantity');
                if($totalQuantity == 0){
                    Session::forget('cart');
                }else {
                    Arr::set($this->cart, 'totalQuantity', $totalQuantity);
                    Arr::forget($this->cart, $itemID);
                    Session::put('cart', $this->cart);
                    Session::save();
                }
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

                $oldTotalQuantity = Arr::get($this->cart, 'totalQuantity');
                $totalQuantity = $oldQuantity > $newQuantity ? $oldTotalQuantity-($oldQuantity - $newQuantity) : $oldTotalQuantity+($newQuantity - $oldQuantity);
                Arr::set($this->cart, 'totalQuantity', $totalQuantity);
                Session::put('cart', $this->cart);
                Session::save();
            }
        }
    }
}
