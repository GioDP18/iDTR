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

    /**
     * Handle login request
     *
     * @param AuthRequest $request
     * @return Http\Response\JasonResponse
     */
    public function login(AuthRequest $request){
        return $this->authService->login($request);
    }

    /**
     * Handle registration request
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request){
        return $this->authService->register($request);
    }

    /**
     * handle user profile request
     *
     * @return void
     * @return Http\Response\JasonResponse
     */
    public function userProfile(){
        return $this->authService->userProfile();
    }

    /**
     * handle new access token request
     *
     * @return void
     * @return Http\Response\JasonResponse
     */
    public function refresh(){
        return $this->authService->refresh();
    }

    /**
     * handle authentication logout
     *
     * @return void
     */
    public function logout(){
        return $this->authService->logout();
    }

    
}