<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    
 
    function index(){
        return view('login');
    }

    function login(Request $req){

        $email = $req->input('email');
        $password = $req->input('password');

        $record = \App\Users::where("email",$email)->first();
        if(isset($record->is_active) && $record->is_active == 1){
           
            if(Hash::check($password, $record->password)){
               
                $req->session()->put('user_id', $record->user_id);
                $req->session()->put('fullname', $record->fullname);
                $req->session()->put('email', $record->email);
                return redirect('dashboard'); 
    
            }else{
                return redirect('/')->withInput(); 
            }
            
        }else{
            $req->session()->flash('error', 'Email or Password is incorrect!');
            return redirect('/')->withInput(); 
        }

        
    }

}
