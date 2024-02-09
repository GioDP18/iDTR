<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface AmDailyTimeRecordService
{
    /**
     * Undocumented function
     */
    public function __construct();

    public function timeInAM(Request $request);

    public function timeOutAM(Request $request);

    public function fetchTimeAM(Request $request);
}
