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

$app->post('api/users/create', '\App\Http\Controllers\UserController@create');

$app->post('file', '\App\Http\Controllers\FileController@saveFile');
$app->get('list', '\App\Http\Controllers\FileController@getFileList');
$app->get('view/{filename}', '\App\Http\Controllers\FileController@viewFile');
$app->get('delete/{filename}', '\App\Http\Controllers\FileController@deleteFile');

use Illuminate\Http\Request;

$app->post('api/auth/login', function(Request $request) {
	$attempt = Auth::attempt($request->only('email', 'password'));
    if ($attempt) {
        return response()->json(['success' => true]);
    }else{
    	return response()->json(['success' => false, 'message' => 'Email or password is incorrect']);
    }

});