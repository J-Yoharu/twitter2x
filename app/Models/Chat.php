<?php

namespace App\Models;

use App\Models\User_chats;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['id'];

    protected $table = 'chats';

    public function user(){
        return $this->belongsTo(User_chats::class);
    }
}
