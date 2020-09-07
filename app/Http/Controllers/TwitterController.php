<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
class TwitterController extends Controller
{
    public function index(Request $request){

        if(session('user')){
            $posts = Post::with('user')->withCount('comments as comments','likes as likes')->orderBy('created_at','asc')->get();
            $postsLiked = Like::where('user_id',session('user')->id)->get();
            return view('index',['posts' => $posts,'likeds','postsLiked' => $postsLiked]);
        }
        
        return redirect()->route('login.index');
    }
    
}
