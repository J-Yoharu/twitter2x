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
            ->select('chat_id','user1.name as name1','user1.username as username1','user2.name as name2','user2.username as username2')
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
            ->select('messages.user_id','users.name','message','messages.chat_id as para_chat')
            ->join('user_chat','messages.chat_id','user_chat.chat_id')
            ->join('users','users.id','messages.user_id')
            ->where('user_chat.chat_id',$id)
            ->orderBy('messages.id')
            ->get();
            
        return response()->json($messages);
    }
}
