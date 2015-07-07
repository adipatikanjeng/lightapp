<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

/**
 *
 */
class AuthController extends Controller {
	function __construct(User $user) {
		$this->model = $user;
	}

	public function register(Request $request) {
		if ($this->model->whereEmail($request->json('email'))->first()) {
			return response()->json(['type' => 'warning', 'message' => 'This email has beed registred!']);
		} else if ($request->json('password') != $request->json('password_confirmation')) {
			return response()->json(['type' => 'warning', 'message' => 'Wrong password confirmation!']);
		} else {
			$model = $this->model;
			$model->name = $request->json('name');
			$model->email = $request->json('email');
			$model->password = bcrypt($request->json('password'));
			if ($model->save()) {
				return response()->json(['type' => 'success', 'title' => 'Success', 'message' => 'Registration successful']);
			}

		}
	}

	public function login(Request $request) {
		$attempt = Auth::attempt(['email' => $request->json('email'), 'password' => $request->json('password')], $request->json('remember'));
		if ($attempt) {
			return response()->json(['type' => 'success', 'title' => 'Success', 'message' => 'Login successfull']);
		} else {
			return response()->json(['type' => 'warning', 'title' => 'Warning', 'message' => 'Email or password is incorrect']);
		}
	}

	public function logout() {
		\Auth::logout();
		return response()->json(['type' => 'success', 'title' => 'Success', 'message' => 'Logout successfull', 'action' => 'logout']);
	}

}