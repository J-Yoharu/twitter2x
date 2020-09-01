<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class postController extends Controller
{
        public function index(){
            return response()->json(Post::all()); 
        }

        public function show($id){
            $post = Post::find($id);
            if($post){
                return response()->json($post);
            }

            return response()->json(['error'=>'Post não encontrado'],404);
        }
        
        public function store(Request $request){
            Post::create($request->all());
            return response()->json(['success'=>'criado o post com sucesso']);

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
