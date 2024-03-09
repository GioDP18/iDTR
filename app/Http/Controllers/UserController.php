<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;

class UserController extends Controller
{
    public function __construct(public UserService $userService)
    {

    }

    public function user($userID)
    {
        return $this->userService->user($userID);
    }

    public function profileInfo($userID)
    {
        return $this->userService->profileInfo($userID);
    }

    public function updateProfile(Request $request)
    {
        return $this->userService->updateProfile($request);
    }

    public function dashboard($id)
    {
        return $this->userService->dashboard($id);
    }

    public function activityLog()
    {
        return $this->userService->activityLog();
    }
}
