<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Events\Comment\UserCommentPost;
use App\Events\Comment\userDeleteComment;
use App\Events\Comment\UserDeleteorEditComment;


class CommentController extends Controller
{
    public function index($id){
        $commentPost = Comment::with('user','post')->where('post_id',$id)->get();
        return response()->json($commentPost);
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
        $create = Comment::create($request->all());
        $post = Comment::with('user')->find($create->id);
        event(new UserCommentPost($post));

        return response()
            ->json($post);
    }

    public function update($id,Request $request){
        $comment = Comment::find($id);
        if($comment && $comment->comment != 'COMENTÁRIO INDISPONÍVEL'){
            $comment->update($request->all());
            event(new UserDeleteorEditComment($comment));
            return response()
                ->json([$comment]);
        }
        return response()
            ->json(['error' => 'Comentário não encontrado ou indisponível'],404);
    }

    public function delete($id){
        $comment = Comment::find($id);
        
        if($comment){
            $comment->delete();
            return response()
                ->json(['success' => 'deletado com sucesso']);
        }
        return response()
                ->json(['error' => 'Comentário não encontrado'],404);
    }
}
