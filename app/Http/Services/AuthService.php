<?php

namespace App\Http\Services;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

interface AuthService {

    public function __construct();

    public function login(AuthRequest $request);

    public function userProfile();

    public function logout();

    public function refresh();
}