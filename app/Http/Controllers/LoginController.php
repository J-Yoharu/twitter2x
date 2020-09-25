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
                    session(['user' => $user]);
                    // return redirect()->route('index');
                    // $posts = Post::with('user')->withCount('comments as comments','likes as likes')->orderBy('posts.id','asc')->get();
                    // $postsLiked = Like::select('post_id')->where('user_id',session('user')->id)->get();
                    // return view('index',['posts' => $posts,'likeds','postsLiked' => $postsLiked]);
                    return redirect()->route("appVue");
                }
                return view('login.index',['error' => 'Senha incorreta']);
            }

            return view('login.index',['error' => 'E-mail não cadastrado']);
    }

}
