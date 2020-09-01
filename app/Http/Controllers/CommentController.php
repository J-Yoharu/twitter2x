<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    public function index(){
        return response()->json(Comment::all());
    }
    
    public function show($id){
        $comment = Comment::find($id);
        dd($comment);
        if($comment){
            return response()
                ->json($comment);
        }
        return response()->json(['error'=>'Comentário não encontrado'],404);
    }

    public function store(Request $request){
        Comment::create($request->all());
        return response()
            ->json(['success'=>'Criado comentário com sucesso']);
    }

    public function update($id,Request $request){
        $comment = Comment::find($id);
        if($comment){
            $comment->update($request->all());
            return response()
                ->json([$comment]);
        }
        return response()
            ->json(['error' => 'Comentário não encontrado'],404);
    }

    public function delete($id){
        $comment = Comment::find($id);
        if($comment){
            return response()
                ->json(['success' => 'deletado com sucesso']);
        }
        return response()
                ->json(['error' => 'Comentário não encontrado'],404);
    }
}
