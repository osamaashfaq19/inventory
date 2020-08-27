<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function index(){
        return view('products/view'); 
    }

    function add(){
        return view('products/add'); 
    }

    function edit($id){
        return view('products/edit'); 
    }
    
}
