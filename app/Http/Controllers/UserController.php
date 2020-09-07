<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\LikedPost;

class UserController extends Controller
{
    public function index(){
        $user =  User::first();
        event(new LikedPost($user));
        return response()->json($user);

    }


    public function show($id){
        $user = User::find($id);
        if($user){
            return response()
                ->json(User::find($id));
        }
        return response()
            ->json(['error'=>'Usuário não encontrado'],404);
    }
    

    public function store(Request $request){
        User::create($request->all());
        return view('login.index');
        // return response() 
        //     ->json(['success'=>'criado o usuário com sucesso']);
    }

    
    public function update($id,Request $request){
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()
                ->json($user);
        }
        return response()
            ->json(['error'=>'Usuário não encontrado'],404);
    }

    
    public function delete($id,Request $request){
        $user = User::find($id);
        
        if($user){
            $user->delete();
            return response()
            ->json(['success' => 'Deletado']);
        }
        
        return response()
        ->json(['error' => 'Usuário não encontrado'],404);
    }
}


