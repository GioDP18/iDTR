<?php

namespace App\Http\Implementations;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Http\Services\ReportService;


class ReportServiceImpl implements ReportService
{
    public function __construct(){
    }

    public function allReport(Request $request){
        $reports = User::find($request->userID)->report;
        return response()->json(['reports'=> $reports]);
    }

    public function createReport(Request $request){
        
        Report::create([
            'users_id' => $request->userID,
            'title' =>  $request->title,
            'content' => $request->content,
        ]);
        return response()->json(['success'=> 'Successfully created report']);
    }

    public function updateReport(Request $request){
        $report = Report::find($request->reportID)->first();

        if (!$report) {
            return response()->json(['error' => 'Report not found']);
        }

        $report->update($request->all());

        return response()->json(['success'=> 'Successfully update report']);
    }
}
