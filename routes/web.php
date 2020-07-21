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

//Cart Controller
Route::get('/mycart', 'CartController@showCart')->name('cart');
Route::post('/addItem/{item}', 'CartController@addItem')->name('addItem');
Route::post('/removeItem', 'CartController@removeItem')->name('removeItem');
Route::post('/changeQuantity', 'CartController@changeQuantity')->name('changeQuantity');

Route::get('/{restaurant}/{branch}', 'MenuController@show')->name('menu');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
