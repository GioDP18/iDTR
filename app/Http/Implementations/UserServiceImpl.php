<?php

namespace App\Http\Implementations;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserService;
use App\Models\AuditLog;
use App\Models\Intern;
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

    public function profileInfo($userID)
    {
        $profile_info = User::with('intern')->find($userID);
        return response()->json([
            'profile_info' => $profile_info,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $intern = Intern::where('users_id', $request->id)->first();
        $intern->firstname = $request->firstname;
        $intern->middlename = $request->middlename;
        $intern->lastname = $request->lastname;
        $intern->gender = $request->gender;
        $intern->birthdate = $request->birthdate;
        $intern->email = $request->email;
        if(!empty($request->avatar)){
            $intern->avatar = $request->file('avatar')->store('avatar', 'public');
        }
        $intern->save();

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        if(!empty($request->current_password) && !empty($request->new_password)){
            if(!password_verify($request->current_password, $user->password)){
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ]);
            }
            $user->password = bcrypt($request->new_password);
        }
        $user->save();
        return response()->json([
          'success' => true,
          'message' => 'Profile updated successfully'
        ]);
    }

    public function dashboard($id)
    {
        $info = Intern::where('user_id', $id)->select([
            'status',
            'completed_hours',
            'remaining_hours',
        ]);

        return response()->json([
            'info' => $info
        ]);
    }

    public function activityLog()
    {
        $log = AuditLog::with('interns')->get();

        return response()->json([
            'log' => $log
        ]);
    }
}

