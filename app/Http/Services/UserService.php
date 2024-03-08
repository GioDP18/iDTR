<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface UserService {

    public function __construct();

    public function user($userID);

    public function updateUser(Request $request);

    public function dashboard($id);
}
