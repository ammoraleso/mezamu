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
Route::get('/', 'HomeController@show')->name('home');

Route::get('/{restaurant}/{branch}', 'MenuController@show')->name('menu');
Route::get('/{restaurant}/{branch}/reserva', 'ReservationController@show')->name('reservation');
Route::post('/waiter', 'WaiterController@generateCode')->name('generateCode');
Route::get('/menuAdmin', 'MenuController@showAdmin')->name('menuAdmin');

//Cart Controller
Route::get('/mycart', 'CartController@showCart')->name('cart');
Route::post('/addItem', 'CartController@addItem')->name('addItem');
Route::post('/removeItem', 'CartController@removeItem')->name('removeItem');
Route::post('/changeQuantity', 'CartController@changeQuantity')->name('changeQuantity');
Route::post('/checkOut', 'CartController@checkOut')->name('checkOut');
Route::post('/checkOutDelivery', 'CartController@checkOutDelivery')->name('checkOutDelivery');
Route::post('/findEmail', 'CartController@findEmail')->name('findEmail');
Route::post('/saveCustomer', 'CartController@uploadCustomer')->name('saveCustomer');
Route::post('/uploadOrder', 'OrderController@uploadOrder')->name('uploadOrder');
Route::post('/updateDelivered', 'OrderController@updateDelivered')->name('updateDelivered');
Route::post('/udpateDishStatus', 'MenuController@udpateDishStatus')->name('udpateDishStatus');
Route::post('/udpateDish', 'MenuController@udpateDish')->name('udpateDish');
Route::get('/successfulPurchase', 'successfulPurchaseController@show')->name('successfulPurchase');
Route::get('/orders','OrderController@loadOrders')->name('orders');
Route::get('/rejectedPurchase', function () {return view('/successfulPurchase');});
Route::get('/pendingPurchase', function () {return view('/successfulPurchase');});

Auth::routes();

Route::get('/invalidToken', function () {
    return view('invalidToken');
})->name('invalidToken');
