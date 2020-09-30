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
            ->select('chat_id','user1.name as user1','user1.id as user1_id','user2.name as user2','user2.id as user2_id')
            ->join('user_chat','chats.id','user_chat.chat_id')
            ->join('users as user1','user1.id','user_chat.user_id')
            ->join('users as user2','user2.id','user_chat.user_id2')
            ->where('user1.id',$id)
            ->orWhere('user2.id',$id)
            ->get();
        return $users;
    }

    public function messages($id){
        $messages = DB::table('messages')
            ->select('messages.user_id as usuario enviando','message','messages.chat_id as para_chat')
            ->join('user_chat','messages.chat_id','user_chat.chat_id')
            ->where('user_chat.chat_id',$id)
            ->orderBy('messages.id')
            ->get();
            
        return response()->json($messages);
    }
}
