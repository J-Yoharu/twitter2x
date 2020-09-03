<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class TwitterController extends Controller
{
    public function index(Request $request){

        if(session('user')){
            $posts = Post::with('user')->withCount('comments as comments','likes as likes')->orderBy('created_at','desc')->get();
            return view('index',['posts' => $posts]);
        }
        
        return redirect()->route('login.index');
    }
    
}
