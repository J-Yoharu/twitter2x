<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/','/home');

Route::get("/",function(){
    $currentUser = session('user');
    return view('appVue',compact('currentUser'));
})->name('appVue');

Route::get('/home','TwitterController@index')->name('index');


Route::prefix('login')->group(function(){
    Route::get('/','LoginController@index')->name('login.index');
    Route::get('/register','LoginController@register')->name('login.register');
    Route::post('/','LoginController@auth')->name('login.auth');
});


Route::prefix('users')->group(function(){

    Route::get('/','UserController@index')->name('user.index');
    Route::get('/{id}','UserController@show')->name('user.show');
    Route::post('/','UserController@store')->name('user.store');
    Route::put('/{id}/edit','UserController@update')->name('user.update');
    Route::delete('/{id}/delete','UserController@delete')->name('user.delete');

});


Route::prefix('posts')->group(function(){
    Route::get('/',"PostController@index")->name('post.index');
    Route::get('/{id}','PostController@show')->name('post.show');
    Route::post('/','PostController@store')->name('post.store');
    Route::put('/{id}/edit','PostController@update')->name('post.update');
    Route::delete('/{id}/delete','PostController@delete')->name('post.delete');


});


Route::prefix('likes')->group(function(){

    Route::get('/',"LikeController@index")->name('like.index');
    Route::get('/{id}',"LikeController@show")->name('like.show');
    Route::post('/',"LikeController@store")->name('like.store');
    Route::delete('/delete',"LikeController@delete")->name('like.delete');

    Route::get('/user/{id}',"LikeController@user")->name('like.user');

});


Route::prefix('comments')->group(function(){

    Route::get('/{id}/all',"CommentController@index")->name('comment.index');
    Route::get('/{id}',"CommentController@show")->name('comment.show');
    Route::post('/',"CommentController@store")->name('comment.store');
    Route::put('/{id}/edit',"CommentController@update")->name('comment.update');
    Route::delete('/{id}/delete',"CommentController@delete")->name('comment.delete');

});

Route::prefix('chats')->group(function(){
    Route::get('/user/{id}','ChatController@show')->name('chat.show');
    Route::get('/{id}/messages','ChatController@messages')->name('chat.messages');
    Route::post('/{id}/messages','ChatController@createMessage');
});

Route::prefix('follows')->group(function(){
    Route::get('/{id}','FollowController@show')->name('follow.show');
});

Route::get('/teste', function(){
   return view('teste');
});
