<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User_chats;
use Illuminate\Support\Facades\DB;
class ChatController extends Controller
{
    public function show($id){
        $users = DB::table('chats')
        ->select('chats.id','user1.name as name1','user1.username as username1','user1.image as image1','user2.name as name2','user2.username as username2','user2.image as image2')
        ->join('user_chat','chats.id','user_chat.chat_id')
        ->join('users as user1','user1.id','user_chat.user_id')
        ->join('users as user2','user2.id','user_chat.user_id2')
        ->where('user1.id',$id)
        ->orWhere('user2.id',$id)
        ->get();

        return response()->json(['chats' => $users]);
    }

    public function messages($id){
        $messages = DB::table('messages')
            ->select('messages.id','user.id as userId','user.image as userImage','user.name as userName','message')
            ->join('user_chat','messages.chat_id','user_chat.chat_id')
            ->join('users as user','user.id','messages.user_id')
            ->where('user_chat.chat_id',$id)
            ->orderBy('messages.id')
            ->get();
            
        return response()->json(['messages' => $messages]);
    }

    public function createMessage(Request $request,$id){
            $message = new Message;
            $message->chat_id = $id;
            $message->message = $request->message;
            $message->user_id = $request->user_id;
            $message->save();
            // event(new UserCreatedPost($post));
            return response()->json($message);
        

    }
}
