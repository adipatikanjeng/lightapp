<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;


/**
* 
*/
class AuthController extends Controller
{
	
	function __construct(User $user)
	{
		$this->model = $user;
	}

	public function register(Request $request)
	{	
		if($this->model->whereEmail($request->email)->first())
		{
			return response()->json(['success' => false, 'message' => 'This email has beed registred!']);
		}else if($request->password != $request->password_confirmation)
		{
			return response()->json(['success' => false, 'message' => 'Wrong password confirmation!']);				
		}else{
			$model = $this->model;
			$model->name = $request->name;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			if($model->save())
				return response()->json(['success' => true, 'message' => 'Registration successful']);	
		}		
	}

	public function login(Request $request)
	{
		$attempt = Auth::attempt($request->only('email', 'password'));
		if ($attempt) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false, 'message' => 'Email or password is incorrect']);
		}
	}
	
}