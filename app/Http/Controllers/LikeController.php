<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

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
        Like::create($request->all());
        return response()->json(['success'=>'criado o like com sucesso']);
    }

    public function delete($id){
        $like= Like::find($id);
        if($like){
            return response()
                ->json(['success'=>'Deletado com sucesso']);
        }
        
        return response()->json(['error'=>'não encontrado'],404);
    }
}
