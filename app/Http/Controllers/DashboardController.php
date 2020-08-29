<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class DashboardController extends Controller
{
    function index(){
        return view('dashboard'); 
    }
    
    function logout(Request $request){

        // Forget multiple keys...
        $request->session()->forget(['user_id', 'fullname', 'email']);
    
        $request->session()->flash('error', 'you are logged out!');
        return redirect('/');
    }
    
}
