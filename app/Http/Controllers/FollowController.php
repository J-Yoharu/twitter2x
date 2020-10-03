<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function show($id){
        $follow = DB::table('follows')
        ->select('follows.id as followId','follow.id','follow.name','follow.username','follow.image')
        ->join('users as user','user.id','follows.user_id')
        ->join('users as follow','follow.id','follows.follow_id')
        ->where('user.id',$id)
        ->get();

        return response()->json(['follows'=>$follow]);

    //     select fo.id, u.id, u.name, f.id, f.name from follows as fo
    // inner join users as u on u.id = fo.user_id
    // inner join users as f on f.id = fo.follow_id
    // where u.id = 1

    }
}
