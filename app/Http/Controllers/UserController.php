<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;


/**
* 
*/
class UserController extends Controller
{
	
	function __construct(User $user)
	{
		$this->model = $user;
	}

	public function create(Request $request)
	{		
		if($request->password == $request->password_confirmation)
		{
			$model = $this->model;
			$model->name = $request->name;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			if($model->save())
			return response()->json('success');
		
		}else{
			return response()->json('error', 404);
		}
		
	}
}