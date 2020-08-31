<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderControllers extends Controller
{
    
    function index(){
        $data['orders'] = \App\Orders::orderBy('orders.order_id', 'desc')
        ->join('users', 'users.user_id', '=', 'orders.user_id')
        ->join('stores', 'stores.store_id', '=', 'orders.store_id')
        ->get();
        return view('orders/view', $data); 
    }

    function add(){
        $data['stores'] = \App\Stores::orderBy('store_name', 'asc')->get();
        $data['products'] = \App\Products::orderBy('product_name', 'asc')->get();
       
        return view('orders/add', $data); 
    }

    function save(Request $req){
        
        $quantity = $req->input('quantity');
        $product_id = $req->input('product_id');
        
        // Totals
        $total_order_discount = 0;
        $total_order_amount = 0;
        $sub_total = 0;

        // Product Details & Totals
        $get_totals = $this->get_totals([], $quantity, $product_id);
       
        // Adding in Orders Table
        $order['order_date'] = $req->input('date');
        $order['store_id'] = $req->input('store_id');
        $order['user_id'] = $req->session()->get('user_id');
        $order['total_discount'] = $get_totals['total_order_discount']; 
        $order['total_amount'] = $get_totals['total_order_amount']; 
        $order['sub_total'] = $get_totals['sub_total']; 

        $order_id = \App\Orders::insertGetId($order);
                
        // Adding Product Details to DB
        $product_details = $this->product_details([], $quantity, $product_id, $order_id);
        
        foreach($product_details['products'] as $details){
            
            $order_detail_id = \App\OrderDetails::insertGetId($details);
            $add_stock = $this->add_stock($order_detail_id, $details);
            $order_detail_id = \App\Stock::insert($add_stock);
        }
        
        $req->session()->flash('success', 'Order Added Successfully!');
        return redirect('orders');

    }

    function edit($order_id){
        
        $data['order'] = \App\Orders::where('order_id',$order_id)->first();
        $data['order_details'] = \App\OrderDetails::where('order_id',$order_id)->get();
        $data['stores'] = \App\Stores::orderBy('store_name', 'asc')->get();
        $data['products'] = \App\Products::orderBy('product_name', 'asc')->get();
        return view('orders/edit', $data); 
    }
    
    function update(Request $req, $order_id){
          
        $quantity = $req->input('quantity');
        $product_id = $req->input('product_id');
        
        // Totals
        $total_order_discount = 0;
        $total_order_amount = 0;
        $sub_total = 0;

        // Product Details & Totals
        $get_totals = $this->get_totals([], $quantity, $product_id);
       
        // Updating in Orders Table
        $order['order_date'] = $req->input('date');
        $order['store_id'] = $req->input('store_id');
        $order['total_discount'] = $get_totals['total_order_discount']; 
        $order['total_amount'] = $get_totals['total_order_amount']; 
        $order['sub_total'] = $get_totals['sub_total']; 

        $update = \App\Orders::where('order_id',$order_id)->update('orders');
                
        $this->delete_product_details($order_id); 

        // Adding Product Details to DB
        $product_details = $this->product_details([], $quantity, $product_id, $order_id);
        
        foreach($product_details['products'] as $details){
            
            $order_detail_id = \App\OrderDetails::insertGetId($details);
            $add_stock = $this->add_stock($order_detail_id, $details);
            $order_detail_id = \App\Stock::insert($add_stock);
        }
        
        $req->session()->flash('success', 'Order Updated Successfully!');
        return redirect('orders');
    }

    function delete(Request $request,$order_id){
        
        $delete_order = \App\Orders::where('order_id', $order_id)->delete();
        
        $this->delete_product_details($order_id); 

        if($result){
            $request->session()->flash('success', 'Order Deleted Successfully!');
            return redirect('orders');
        
        }else{
            $request->session()->flash('wrong', 'Something went wrong!');
            return redirect('orders');
        }
    }
    
    function product_details($data = [],$quantity = [],$product_id = [], $order_id){
        
        $total_order_discount = 0;
        $total_order_amount = 0;
        $sub_total = 0;
        
        for($i = 0; $i < count($quantity); $i++){
            
            // Total Working
            $products = \App\Products::where('product_id',  $product_id[$i])->first();
            
            $total_order_discount = ($total_order_discount + $products->t_o_discount_amount + $products->trade_discount + $products->scheme_discount_amount) * $quantity[$i];
            $sub_total = ($sub_total + $products->trade_price) * $quantity[$i];
            $total_order_amount = ($total_order_amount + $products->total_product_price) * $quantity[$i];

            $data['products'][] = array(
                'order_id'                      =>   $order_id,
                'quantity'                      =>   $quantity[$i],
                'product_id'                    =>   $product_id[$i],
                't_o'                       =>   $products->t_o,
                't_o_discount_amount'           =>   $products->t_o_discount_amount * $quantity[$i],
                'trade_discount'                =>   $products->trade_discount  * $quantity[$i],  
                'trade_discount_percent'        =>   $products->trade_discount_percent,  
                'scheme_discount'               =>   $products->scheme_discount,  
                'scheme_discount_amount'        =>   $products->scheme_discount_amount  * $quantity[$i]  
            );

        }
        return $data;
    }

    function get_totals($data = [],$quantity = [],$product_id = []){
        
        $data['total_order_discount'] = 0;
        $data['sub_total'] = 0;
        $data['total_order_amount'] = 0;
        
        for($i = 0; $i < count($quantity); $i++){
            
            // Total Working
            $products = \App\Products::where('product_id',  $product_id[$i])->first();
            
            $discount = ($products->t_o_discount_amount + $products->trade_discount + $products->scheme_discount_amount) * $quantity[$i];
            $sub_total = $products->trade_price * $quantity[$i];
            $total_price = $products->total_product_price * $quantity[$i]; 
            
            $data['total_order_discount'] = ($data['total_order_discount'] + $discount);
            $data['sub_total'] = ($data['sub_total'] + $sub_total);
            $data['total_order_amount'] = ($data['total_order_amount'] + $total_price);

        }
        return $data;
    }

    function add_stock($order_detail_id, $product_details){
        
        $data = array(
            'sell'                          =>   1,
            'quantity'                      =>   $product_details['quantity'],
            'order_detail_id'               =>   $order_detail_id 
        );
        
        return $data;
    }

    function delete_product_details($order_id){
         
        // Deleteing Product Details
         $product_details = \App\OrderDetails::where('order_id', $order_id)->get();
         foreach($product_details as $detail){
             $delete_stock = \App\Stock::where('order_detail_id', $detail->order_detail_id)->delete(); 
         }
         $result = \App\OrderDetails::where('order_id', $order_id)->delete();
    }
}
