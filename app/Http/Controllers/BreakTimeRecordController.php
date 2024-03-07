<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BreakTimeRecordService;

class BreakTimeRecordController extends Controller
{
    public function __construct(public BreakTimeRecordService $breakTimeRecordService)
    {
        
    }

    public function allBreakTime($userID)
    {
        return $this->breakTimeRecordService->allBreakTime($userID);
    }

    public function addBreakTime(Request $request)
    {
        return $this->breakTimeRecordService->addBreakTime($request);
    }
}
