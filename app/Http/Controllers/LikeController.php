<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Events\Like\LikedPost;
use App\Events\Like\DeslikePost;

class LikeController extends Controller
{
    public function index(){
        return response()
            ->json(Like::all());
    }

    public function show($id){
        $like = Like::find($id);
        if($like){
            return response()
                ->json($like);
        }
        return response()
            ->json(['error'=>'Like não encontrado'],404);
    }

    public function store(Request $request){
        event(new LikedPost(Like::create($request->all())));

        return response()->json(['success'=>'criado o like com sucesso']);
    }

    public function delete(Request $request){
        $like= Like::where([
            ['user_id','=',$request->user_id],
            ['post_id','=',$request->post_id],
        ])->first();
            
        if($like){
            event(new DeslikePost($like));
            
            $like->delete();
            return response()
                ->json(['success'=>'removido']);
        }
        
        return response()->json(['error'=>'não encontrado'],404);
    }
    public function user($id){
        $likes = Like::where('user_id','=',$id)->get();
        return response()->json($likes);
    }
}
