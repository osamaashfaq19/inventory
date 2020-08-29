<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    function index(){
        $result['users'] =  \App\Users::get();
        return view('users/view', $result);
    }

    function add(){
        return view('users/add');
    }
    

    function save(Request $request){
        

        if($this->check_user_exists($request->input('email')) == false){
            $data=array(
                'fullname'          =>  $request->input('fullname'),
                'email'             =>  $request->input('email'),
                'password'          =>  Hash::make($request->input('password')),
                'phone'             =>  $request->input('phone'),
                'user_type'          =>  $request->input('user_type'),
            );
            $result =  \App\Users::insert($data);
            if($result){
                $request->session()->flash('success', 'User Added Successfully!');
                return redirect('users');
            }
        }else{
            $request->session()->flash('error', 'User already exists with this email in the system!');
            return redirect('users');
        }
    }

    function delete(Request $request,$id){
        $result = \App\Users::where('user_id', $id)->delete();
        if($result){
            $request->session()->flash('success', 'User Deleted Successfully!');
            return redirect('users');
        }else{
            $request->session()->flash('wrong', 'Something went wrong!');
            return redirect('users');
        }
    }

    function edit($id){
        $data['users'] = \App\Users::where('user_id', $id)->first();
        return view('users/edit', $data);
    }

    function update(Request $request, $id){
       
        $data=array(
            'fullname'           =>  $request->input('fullname'),
            'email'              =>  $request->input('email'),
            'phone'              =>  $request->input('phone'),
            'user_type'          =>  $request->input('user_type'),
            'is_active'          =>  $request->input('is_active')
        );
        
        $password = '';
        $pass['password'] = '';
        $insert = $data; 
        if(!empty($request->input('password'))){
            $pass['password'] = Hash::make($request->input('password'));
            $insert = array_merge($data,$pass);
        }

        $result = \App\Users::where('user_id', $id)->update($insert);
        if($result){
            $request->session()->flash('success', 'User Updated Successfully!');
        }else{
            $request->session()->flash('error', 'No changes were made!');
        }

        return redirect('users');

    }

    function check_user_exists($email){
        $result = \App\Users::where('email', $email)->first();
        $action = false;
        if(isset($result->email)){
            $action=true;
        }
        return $action;
    }

}
