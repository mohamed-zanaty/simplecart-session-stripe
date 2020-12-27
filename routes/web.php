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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/store', 'HomeController@store')->name('store');

Route::resource('products', 'ProductController');
Route::get('add-to-cart/{id}', 'ProductController@addToCart')->name('add');
Route::post('delete/{id}', 'ProductController@delete')->name('delete');
Route::post('edit/{id}', 'ProductController@edit')->name('edit');
Route::get('shopping', 'ProductController@showCart')->name('show');
Route::get('check/{amount}', 'ProductController@check')->name('check')->middleware('auth');
Route::post('charge', 'ProductController@charge')->name('charge')->middleware('auth');


Route::get('order', 'OrderController@index')->name('order.index')->middleware('auth');
