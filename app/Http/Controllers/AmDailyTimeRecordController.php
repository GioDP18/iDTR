<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AmDailyTimeRecordService;

class AmDailyTimeRecordController extends Controller
{
    
    public function __construct(public AmDailyTimeRecordService $amDailyTimeRecordService)
    {

    }

    public function timeInAM(Request $request)
    {
        return $this->amDailyTimeRecordService->timeInAM($request);
    }

    public function timeOutAM(Request $request)
    {
        return $this->amDailyTimeRecordService->timeOutAM($request);
    }

    public function fetchTimeAM(Request $request)
    {
        return $this->amDailyTimeRecordService->fetchTimeAM($request);
    }
}
