<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\Post\UserCreatedPost;
use App\Events\Post\UserDeletePost;
use App\Events\Post\UserEditPost;
use DB;

class postController extends Controller
{
        public function index(){
            //log DB.
            // DB::enableQueryLog();
            // $queries = DB::getQueryLog(Post::with('user')->withCount('comments as comments','likes as likes')->get());
            // dd($queries);
            return response()->json( Post::with('user','likes')->withCount('comments as comments')->get()); 
            
        }

        public function show($id){
            // DB::enableQueryLog();
            // $queries = DB::getQueryLog(Post::with('user')->withCount('comments as comments','likes as likes')->find($id));
            // dd($queries);
         
            $post = Post::with('user','likes','comments')->withCount('comments as comments','likes as likes')->find($id);
            if($post){
                return response()
                    ->json($post);
            }

            return response()->json(['error'=>'Post não encontrado'],404);
        }
        
        public function store(Request $request){
            if(session('user')->id == $request->user_id){
                $create = Post::create($request->all());
                $post = Post::with('user','likes')->withCount('comments as comments')->find($create->id);
                event(new UserCreatedPost($post));
                return response()->json($post);
            }

            return response()->json(['error' => 'Usuário sem permissão para twittar']);

        }
        public function update($id,Request $request){
            $post = Post::find($id);
            if($post){
                $post->update($request->all());
                event(new UserEditPost($post));
                return response()
                    ->json($post);
            }
            return response()->json(['error'=>'Post não encontrado'],404);
        }
        public function delete($id){
            $post = Post::find($id);
            if($post){
                event(new UserDeletePost($post));
                $post->delete();
                return response()
                    ->json($post);
            }
            return response()
                ->json(['error'=>'Post não encontrado'],404);
        }

}
