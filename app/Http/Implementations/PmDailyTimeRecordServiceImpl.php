<?php

namespace App\Http\Implementations;

use App\Models\PmDailyTimeRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Services\PmDailyTimeRecordService;


class PmDailyTimeRecordServiceImpl implements PmDailyTimeRecordService
{
    public function __construct(){
        date_default_timezone_set('Asia/Manila');
    }

    public function timeInPM(Request $request){
        
        $existingTimeIn = PmDailyTimeRecord::whereDate('date', now()->format('Y-m-d'))
            ->where('users_id', $request->userID)
            ->first();
        if ($existingTimeIn) {
            return response()->json(['error' => 'Time in already exists for today']);
        }
        
        $currentTime = Carbon::now();
        $expectedTime = Carbon::createFromTime(12, 0, 0); 
        $lateness = $currentTime->diff($expectedTime);
        $formattedLateness = $lateness->format('%H:%I:%S');
        
        $res = PmDailyTimeRecord::create([
            'users_id' => $request->userID,
            'arrival_pm' => $currentTime,
            'late_pm' => $formattedLateness,
            'date' => now()->format('Y-m-d'),
        ]);
        
        return response()->json($res);
    }

    public function timeOutPM(Request $request){

        $existingTimeIn = PmDailyTimeRecord::whereDate('date', now()->format('Y-m-d'))
            ->where('users_id', $request->userID)
            ->first();
        $departureifexist = $existingTimeIn->departure_pm;
        if($departureifexist != null){
            return response()->json(['error'=>"Already timed out today"]);
        }
        
        $departure_pm = Carbon::now();
        $arrival_pm = $existingTimeIn->arrival_pm;
        $hours_worked_pm = $departure_pm->diff($arrival_pm);
        $formatted_hours_worked_pm = $hours_worked_pm->format('%H:%I:%S');
        

        $existingTimeIn->update([
            'departure_pm' =>  $departure_pm,
            'hours_worked_pm' => $formatted_hours_worked_pm
        ]);

        return response()->json(['success'=>"Successfully Timed out"]);
    }

    public function getTimePM(Request $request){
        
        $recordPM = PmDailyTimeRecord::where('users_id', $request->userID)
            ->orderBy('id', 'asc')
            ->get();
        
        return response()->json([
            'recordPM' => $recordPM,
        ], 200);
    }
}