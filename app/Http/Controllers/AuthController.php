<?php
namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(public AuthService $authService) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthRequest $request){
        return $this->authService->login($request);
    }

    public function userProfile(){
        return $this->authService->userProfile();
    }

    public function refresh(){
        return $this->authService->refresh();
    }

    public function logout(){
        return $this->authService->logout();
    }

    
}