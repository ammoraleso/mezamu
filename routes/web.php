<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return view('/home');
    }
    return view('welcome');
});

Route::get('/{restaurant}/{branch}', 'MenuController@show')->name('menu');
Route::post('/waiter', 'WaiterController@generateCode')->name('generateCode');

//Cart Controller
Route::get('/mycart', 'CartController@showCart')->name('cart');
Route::post('/addItem', 'CartController@addItem')->name('addItem');
Route::post('/removeItem', 'CartController@removeItem')->name('removeItem');
Route::post('/changeQuantity', 'CartController@changeQuantity')->name('changeQuantity');
Route::post('/checkOut', 'CartController@checkOut')->name('checkOut');
Route::post('/findEmail', 'CartController@findEmail')->name('findEmail');
Route::post('/saveCustomer', 'CartController@uploadCustomer')->name('saveCustomer');
Route::get('/successfulPurchase', function () {return view('/successfulPurchase');});
Route::get('/rejectedPurchase', function () {return view('/successfulPurchase');});
Route::get('/pendingPurchase', function () {return view('/successfulPurchase');});

Auth::routes();

Route::get('/invalidToken', function () {
    return view('invalidToken');
})->name('invalidToken');
