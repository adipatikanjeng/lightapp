<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function(){
	return view('index');
});
$app->get('api/user/profile/{email}', '\App\Http\Controllers\UserController@profile');
$app->post('api/auth/register', '\App\Http\Controllers\AuthController@register');
$app->post('api/auth/login', '\App\Http\Controllers\AuthController@login');


$app->group(['middleware' => 'authFile'], function($app){
	$app->post('file/upload', '\App\Http\Controllers\FileController@upload');
	$app->get('file/lists', '\App\Http\Controllers\FileController@lists');

	$app->get('file/view/{filename}', '\App\Http\Controllers\FileController@view');
	$app->get('file/delete/{filename}', '\App\Http\Controllers\FileController@delete');

});

$app->get('logout', function(){
	\Auth::logout();
	return response()->json('success logout');
});
