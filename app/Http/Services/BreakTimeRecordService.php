<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface BreakTimeRecordService {

    public function __construct();
    
    public function allBreakTIme($userID);

    public function addBreakTime(Request $request);
    
}
