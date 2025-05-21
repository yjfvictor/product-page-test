<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
	use HasApiTokens;

	public function Login(Request $request)
	{
		$userInfo = $request->validate([
			'email' => 'required|email',
			'password' => 'required|string',
		]);
		$userItem = User::where('email', $userInfo['email'])->firstOrFail();
		if (sha1($userInfo['password']) == ($userItem->password))
		{
			$plainTextToken = $userItem->createToken('API Token')->plainTextToken;
			$response = [
				'success' => true,
				'token' => $plainTextToken,
			];
			return response()->json($response);
		}
		else
		{
			return response()->json(["success" => false]);
		}
	}
}
