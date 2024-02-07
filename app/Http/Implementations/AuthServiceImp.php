<?php

namespace App\Http\Implementations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Services\AuthService;

class AuthServiceImp implements AuthService
{
    public function __construct(){
    }
    
    /**
     * Perform the login authentication
     *
     * @param AuthRequest $request
     * @return createNewToken
     */
    public function login(AuthRequest $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    /**
     * handle the token creation
     *
     * @param [type] $token
     * @return Http\Response\JasonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * Get the authenticated user information
     *
     * @return Http\Response\JasonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * handle creation of new access token
     *
     * @return createNewToken
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * handle logout the authenticated user
     *
     * @return Http\Response\JasonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


}