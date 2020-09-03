<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
            $post = Post::create($request->all());
            return response()->json($post);

        }
        public function update($id,Request $request){
            $post = Post::find($id);
            if($post){
                $post->update($request->all());
                return response()
                    ->json($post);
            }
            return response()->json(['error'=>'Post não encontrado'],404);
        }
        public function delete($id){
            $post = Post::find($id);
            if($post){
                $post->delete();
                return response()
                    ->json(['success'=>'Post deletado com sucesso']);
            }
            return response()
                ->json(['error'=>'Post não encontrado'],404);
        }

}
