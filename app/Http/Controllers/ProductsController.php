<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ProductsController extends Controller
{
    function index(){
        $data['products'] =  \App\Products::get();
        return view('products/view', $data);
    }

    function add(Request $request){
        return view('products/add');
    }
    

    function save(Request $request){
        
        $trade_discount  = $request->input('trade_discount');
        $trade_discount_percent = $request->input('trade_discount_percent'); 
        $scheme_discount = $request->input('scheme_discount'); 
        $t_o = $request->input('t_o'); 
        $trade_price = $request->input('trade_price');
        
        $calculation = $this->total_product_price($trade_discount,$trade_discount_percent, $scheme_discount, $t_o, $trade_price);
       
        $data=array(
            'product_name'              =>  $request->input('product_name'),
            'price'                     =>  $request->input('price'),
            'trade_price'               =>  $trade_price,
            't_o'                       =>  $t_o,
            'trade_discount'            =>  $calculation['trade_discount_amount'],
            'trade_discount_percent'    =>  $request->input('trade_discount_percent'),
            'scheme_discount'           =>  $request->input('scheme_discount'),
            'total_product_price'       =>  $calculation['total_product_price']
        );

        $result =  \App\Products::insert($data);
        if($result){
            $request->session()->flash('success', 'Product Added Successfully!');
            return redirect('products');
        }else{
            echo 'Something went wrong!';
        }
    }

    function delete(Request $request,$id){
        $result = \App\Products::where('product_id', $id)->delete();
        if($result){
            $request->session()->flash('success', 'Product Deleted Successfully!');
            return redirect('products');
        }else{
            $request->session()->flash('wrong', 'Something went wrong!');
            return redirect('products');
        }
    }

    function edit($id){
        $data['products'] = \App\Products::where('product_id', $id)->first();
        return view('products/edit', $data);
    }

    function update(Request $request, $id){
        
        $trade_discount  = $request->input('trade_discount');
        $trade_discount_percent = $request->input('trade_discount_percent'); 
        $scheme_discount = $request->input('scheme_discount'); 
        $t_o = $request->input('t_o'); 
        $trade_price = $request->input('trade_price');
        
        $calculation = $this->total_product_price($trade_discount,$trade_discount_percent, $scheme_discount, $t_o, $trade_price);
       
        $data=array(
            'product_name'              =>  $request->input('product_name'),
            'price'                     =>  $request->input('price'),
            'trade_price'               =>  $trade_price,
            't_o'                       =>  $t_o,
            'trade_discount'            =>  $calculation['trade_discount_amount'],
            'trade_discount_percent'    =>  $request->input('trade_discount_percent'),
            'scheme_discount'           =>  $request->input('scheme_discount'),
            'total_product_price'       =>  $calculation['total_product_price']
        );
       
        $result =  \App\Products::where('product_id', $id)->update($data);
        if($result){
            $request->session()->flash('success', 'Product Updated Successfully!');
            return redirect('products');
        }else{
            $request->session()->flash('error', 'No Changes were made!');
            return redirect('stores');
        }
    }

    function total_product_price($trade_discount,$trade_discount_percent, $scheme_discount, $t_o, $trade_price){

        $scheme=0;
        if($scheme_discount > 0){
            $scheme = ($scheme_discount * $trade_price) / 100;
        }
        
        $trade_discount_amount = 0;
        if($trade_discount_percent == 0){
            $trade_discount_amount = $trade_discount;            
        }else{
            $trade_discount_amount = ($trade_discount_percent * $trade_price) / 100;
        }

        $t_o_amount = ($t_o * $trade_price) / 100;
        
        $data['total_product_price'] = $trade_price - $trade_discount_amount - $scheme - $t_o_amount;  
        $data['trade_discount_amount'] = $trade_discount_amount;


        return $data; 
       
    }

}

