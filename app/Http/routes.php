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

// $app->get('/', function() use ($app) {
//     return $app->welcome();
// });
$app->get('/', function(){
	return view('index');
});
$app->get('api/user/profile/{email}', '\App\Http\Controllers\UserController@profile');
$app->post('api/auth/register', '\App\Http\Controllers\AuthController@register');
$app->post('api/auth/login', '\App\Http\Controllers\AuthController@login');



// $app->post('file', '\App\Http\Controllers\FileController@saveFile');
// $app->get('list', '\App\Http\Controllers\FileController@getFileList');
// $app->get('view/{filename}', '\App\Http\Controllers\FileController@viewFile');
// $app->get('delete/{filename}', '\App\Http\Controllers\FileController@deleteFile');