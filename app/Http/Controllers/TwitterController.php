<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(Request $request){

        if(session('user')){
            return view('index');
        }
        
        return redirect()->route('login.index');
    }
    
}
