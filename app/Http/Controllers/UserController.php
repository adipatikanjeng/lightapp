<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;


/**
* 
*/
class UserController extends Controller
{
	
	function __construct(User $user)
	{
		$this->model = $user;
	}

	public function profile($email)
	{		
		$model = $this->model->whereEmail($email)->first();
		return response()->json($model);
	}
}