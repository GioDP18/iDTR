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
    public function timeInPM()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function timeOutPM()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PmDailyTimeRecord $pmDailyTimeRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PmDailyTimeRecord $pmDailyTimeRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PmDailyTimeRecord $pmDailyTimeRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PmDailyTimeRecord $pmDailyTimeRecord)
    {
        //
    }
}
