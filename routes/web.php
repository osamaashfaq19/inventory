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
Route::get('/','UserController@index');
Route::post('/login','UserController@login');

// Dashboard
Route::get('/dashboard','DashboardController@index');

// Products
Route::get('/products','ProductsContoller@index');
Route::get('/products/add-products','ProductsContoller@add');




