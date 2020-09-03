<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User; 
use DB;

class LoginController extends Controller
{
    public function index(){
        session()->get('user') ? session()->forget('user'):false; 
        
        return view('login.index');
    }

    public function register(){
        return view('login.register');
    }

    public function auth(LoginRequest $request){
            $user = User::where('email',$request->email)->first();

            if($user){
                if($user->password == $request->password){
                    return redirect()->route('index')->with(['user' => $user]);
                    return view('index',['user' => $user]);
                }
                return view('login.index',['error' => 'Senha incorreta']);
            }

            return view('login.index',['error' => 'E-mail não cadastrado']);
    }
}
