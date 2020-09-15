<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('register',[
    'as' => 'register' ,
    'uses' => 'Auth\UserRegisterController@getRegister',
]);

Route::post('register',[
    'as' => 'register' ,
    'uses' => 'Auth\UserRegisterController@postRegister',
]);

Route::get('link/verification/{id}/{tokenRegister?}',[
    'as' => 'verification' ,
    'uses' => 'Auth\VerifyController@index',
]);