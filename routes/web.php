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

Route::get('/categories', 'CategoryController@index')->name('categories');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/orders', 'OrdersController@index')->name('toOrders');

Route::post('/categories', 'CategoryController@addCategory')->name('addCategory');

Route::get('/categories/{category}/redact', 'CategoryController@indexRedactCategory')->name('goToRedactCategory');

Route::post('/categories/{category}/redact', 'CategoryController@redactCategory')->name('redactCategory');

Route::get('/categories/{category}/delete', 'CategoryController@deleteCategory')->name('deleteCategory');

Route::post('/categories/{category}', 'ProductController@addProduct')->name('addProduct');

Route::get('/categories/{category}', 'ProductController@index')->name('products');

Route::get('/categories/{category}/{product}', 'OneProductController@index')->name('toProduct');

Route::get('/categories/{category}/{product}/delete', 'OneProductController@deleteProduct')->name('deleteProduct');

Route::get('/categories/{category}/{product}/buy', 'OneProductController@buyProductIndex')->name('buyProduct');

Route::post('/categories/{category}/{product}/buy', 'OneProductController@confirmBuy')->name('confirmBuy');

Route::post('/categories/{category}/{product}/redact', 'OneProductController@redactProduct')->name('redactProduct');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
