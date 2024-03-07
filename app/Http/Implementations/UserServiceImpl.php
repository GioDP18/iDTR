<?php

namespace App\Http\Implementations;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserService;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserServiceImpl implements UserService
{
    public function __construct(){
    }

    public function user($userID)
    {
        $user = User::find($userID)->intern;
        return response()->json([
            'user' => $user,
        ]);
    }
    
    public function updateUser(Request $request)
    {
        #pass
    }

}

