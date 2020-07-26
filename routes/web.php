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
    return view('welcome');
});

Route::get('/{restaurant}/{branch}', 'MenuController@show')->name('menu');
Route::get('/{restaurant}/{branch}/{table}/{token}', 'MenuController@menuWithToken')->name('menu');
Route::get('/{restaurant}/{branch}/mesero', 'WaiterController@show')->name('waiter');
Route::post('/waiter', 'WaiterController@generateCode')->name('generateCode');

//Cart Controller
Route::get('/mycart', 'CartController@showCart')->name('cart');
Route::post('/addItem', 'CartController@addItem')->name('addItem');
Route::post('/removeItem', 'CartController@removeItem')->name('removeItem');
Route::post('/changeQuantity', 'CartController@changeQuantity')->name('changeQuantity');
Route::get('/', 'CartController@sendOrder')->name('sendOrder');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/invalidToken', function () {
    return view('invalidToken');
})->name('invalidToken');
