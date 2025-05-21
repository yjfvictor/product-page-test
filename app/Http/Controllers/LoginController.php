<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function Login(Request $request)
	{
		$json = ["message" => 'Please send email and password to /api/user/login']; 
		return response()->json($json);
	}
}
