<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    protected $fillable = ['user_id','follow_id'];

    protected $table = 'follows';

    public function users(){
        return $this->hasMany('App\Models\User','id','user_id');
    }
    public function follow(){
        return $this->hasMany('App\Models\User','id','follow_id');
    }

}
