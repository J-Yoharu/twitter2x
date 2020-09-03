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
    Route::get('/',"PostController@index");
    Route::get('/{id}','PostController@show');
    Route::post('/','PostController@store');
    Route::put('/{id}/edit','PostController@update');
    Route::delete('/{id}/delete','PostController@delete');

});


Route::prefix('likes')->group(function(){

    Route::get('/',"LikeController@index");
    Route::get('/{id}',"LikeController@show");
    Route::post('/',"LikeController@store");
    Route::delete('/{id}/delete',"LikeController@delete");

});


Route::prefix('comments')->group(function(){

    Route::get('/',"CommentController@index");
    Route::get('/{id}',"CommentController@show");
    Route::post('/',"CommentController@store");
    Route::put('/{id}/edit',"CommentController@update");
    Route::delete('/{id}/delete',"CommentController@delete");

});