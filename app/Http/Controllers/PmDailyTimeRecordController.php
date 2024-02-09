<?php

namespace App\Http\Controllers;

use App\Models\PmDailyTimeRecord;
use Illuminate\Http\Request;
use App\Http\Services\PmDailyTimeRecordService;

class PmDailyTimeRecordController extends Controller
{

    public function __construct(public PmDailyTimeRecordService $pmDailyTimeRecordService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function timeInPM(Request $request)
    {
        return $this->pmDailyTimeRecordService->timeInPM($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function timeOutPM(Request $request)
    {
        return $this->pmDailyTimeRecordService->timeOutPM($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getTimePM(Request $request)
    {
        return $this->pmDailyTimeRecordService->getTimePM($request);
    }


}
