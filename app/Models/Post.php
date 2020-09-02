<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post','user_id','image_post'];

    protected $table = 'posts';

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
