<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(){
        if(!session()->get('user')){
            return redirect()->route('login.index');
        }
        return view('index');
    }
    
}
