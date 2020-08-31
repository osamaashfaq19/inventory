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

// User 
Route::get('/',function(){
    if(!session()->has('user_id')){
        return view('login');
    }else{
        return redirect('dashboard');
    }
});

Route::post('/login','LoginController@login');

// Dashboard
Route::get('/dashboard','DashboardController@index');
Route::get('/dashboard/logout','DashboardController@logout');


// Store
Route::get('/stores','StoreController@index');
Route::get('/stores/add','StoreController@add');
Route::post('/stores/save','StoreController@save');
Route::get('/stores/delete/{id}','StoreController@delete');
Route::get('/stores/edit/{id}','StoreController@edit');
Route::post('/stores/update/{id}','StoreController@update');


// Products
Route::get('/products','ProductsController@index');
Route::get('/products/add','ProductsController@add');
Route::post('/products/save','ProductsController@save');
Route::get('/products/delete/{id}','ProductsController@delete');
Route::get('/products/edit/{id}','ProductsController@edit');
Route::post('/products/update/{id}','ProductsController@update');

// User Managment
Route::get('/users','UsersController@index');
Route::get('/users/add','UsersController@add');
Route::post('/users/save','UsersController@save');
Route::get('/users/delete/{id}','UsersController@delete');
Route::get('/users/edit/{id}','UsersController@edit');
Route::post('/users/update/{id}','UsersController@update');

// book order
Route::get('/orders','OrderControllers@index');
Route::get('/orders/add','OrderControllers@add');
Route::post('/orders/save','OrderControllers@save');
Route::get('/orders/delete/{id}','OrderControllers@delete');
Route::get('/orders/edit/{id}','OrderControllers@edit');
Route::post('/orders/update/{id}','OrderControllers@update');




