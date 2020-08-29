<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class StoreController extends Controller
{
    function index(){
        $result['stores'] =  \App\Stores::get();
        return view('store/view', $result);
    }

    function add(Request $request){
        return view('store/add');
    }
    

    function save(Request $request){
        
        $data=array(
            'store_name'    =>  $request->input('store_name'),
            'street'        =>  $request->input('street'),
            'area'          =>  $request->input('area'),
            'phone'         =>  $request->input('phone'),
            'city'          =>  $request->input('city'),
            'store_keeper_name'          =>  $request->input('store_keeper_name')
        );
        $result =  \App\Stores::insert($data);
        if($result){
            $request->session()->flash('success', 'Store Added Successfully!');
            return redirect('stores');
        }else{
            echo 'Something went wrong!';
        }
    }

    function delete(Request $request,$id){
        $result = \App\Stores::where('store_id', $id)->delete();
        if($result){
            $request->session()->flash('success', 'Store Deleted Successfully!');
            return redirect('stores');
        }else{
            $request->session()->flash('wrong', 'Something went wrong!');
            return redirect('stores');
        }
    }

    function edit($id){
        $data['store'] = \App\Stores::where('store_id', $id)->first();
        return view('store/edit', $data);
    }

    function update(Request $request, $id){
        $data=array(
            'store_name'                 =>  $request->input('store_name'),
            'street'                     =>  $request->input('street'),
            'area'                       =>  $request->input('area'),
            'phone'                      =>  $request->input('phone'),
            'city'                       =>  $request->input('city'),
            'store_keeper_name'          =>  $request->input('store_keeper_name')
        );
        $result = \App\Stores::where('store_id', $id)->update($data);
        if($result){
            $request->session()->flash('success', 'Store Updated Successfully!');
            return redirect('stores');
        }else{
            $request->session()->flash('error', 'No Changes were made!');
            return redirect('stores');
        }
    }


}
