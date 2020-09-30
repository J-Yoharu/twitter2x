<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_chats extends Model
{
    protected $fillable = ['chat_id','user_id','user_id2'];

    protected $table = 'user_chat';
}
