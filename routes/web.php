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

Route::get('/login', function () {
    return view('register/login');
})->name('login');

Route::get('/signup', function () {
    return view('register/signup');
})->name('signup');

Route::get('/reset_password', function () {
    return view('register/password/reset');
})->name('reset_password');

Route::get('/reset_password_email', function () {
    return view('register/password/email');
})->name('reset_password_email');

Route::get('/{restaurant}/{branch}', 'MenuController@show')->name('menu');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
