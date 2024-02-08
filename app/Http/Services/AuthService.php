<?php

namespace App\Http\Services;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

interface AuthService {

    /**
     * Undocumented function
     */
    public function __construct();

    /**
     * Service for login authentication and jwt token
     *
     * @param AuthRequest $request
     * @return void
     */
    public function login(AuthRequest $request);

    /**
     *  service for Get the authenticated user information
     *
     * @return void
     */
    public function userProfile();

    /**
     * service for handling creation of new access token
     *
     * @return void
     */
    public function refresh();

    /**
     * service for handling logout the authenticated user
     *
     * @return void
     */
    public function logout();
    
}