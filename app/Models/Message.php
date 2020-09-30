<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','user_id','chat_id']

    protected $table = 'messages'
}
