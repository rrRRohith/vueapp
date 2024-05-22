<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\{
    LoginRequest, RegisterRequest
};
use \Auth;
class AuthController extends Controller
{
    /**
     * Authenticate registered user.
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try{
            Auth::attempt($request->validated());
            return $this->authenticated(Auth::user());
		}
		catch(\Exception $e){
			return response()->json([
                'success' => false,
                'message' => __('messages.error')
            ], 500);
		}
    }

    /**
     * Register new user.
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
		try{
           return $this->authenticated(User::create($request->validated()));
		}
		catch(\Exception $e){
			return response()->json([
                'success' => false,
                'message' => __('messages.error')
            ], 500);
		}
    }

    /**
     * Get authenticated response
     * @param array
     */
    private function authenticated(User $user)
    {
        return response()->json([
            'success' => true,
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user->toArray(),
        ]);
    }
}
