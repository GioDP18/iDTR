<?php

namespace App\Http\Implementations;

use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Services\AuthService;
use App\Models\Intern;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    public function login(Request $request){
        
        $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required|string|min:6',
        ]);
        
        
        $token = JWTAuth::attempt([
            "username" => $request->username,
            "password" => $request->password
        ]);
        if(!empty($token)){

            return $this->createNewToken($token);
        }
        return response()->json(["error" => 'invalid details'], 401);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3',
            'middlename' => 'required|min:3',
            'lastname' => 'required|min:3',
            'gender' =>'required',
            'birthdate' =>'required',
            'email' => 'required|string|email|max:100|unique:users',
            'username' => 'required|string|between:2,100',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if($validator){
            $user = User::create([
                'username' => $request->password,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            if($user){
                Intern::create([
                    'users_id' => $user->id,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'email' => $request->email,
                ]);
            }
        }
        
        return response()->json([
            'message' => 'User successfully registered',
            'newId' => $user->id,
            'user' => $user
        ], 201);
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