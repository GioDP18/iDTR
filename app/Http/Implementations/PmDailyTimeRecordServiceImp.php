<?php

namespace App\Http\Implementations;

use App\Models\PmDailyTimeRecord;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Services\PmDailyTimeRecordService;

class PmDailyTimeRecordImp extends PmDailyTimeRecordService
{
    public function __construct(){
    }

    public function timeInPM(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        
        $existingTimein = PmDailyTimeRecord::whereDate('date', now()->format('Y-m-d'))->first();
        if ($existingTimein) {
            return response()->json(['error' => 'Time in already exists for today']);
        }
        
        $currentTime = Carbon::now();
        $expectedTime = Carbon::createFromTime(12, 0, 0);
        if ($currentTime->greaterThan($expectedTime)) {
            
            $lateness = $currentTime->diffInMinutes($expectedTime);
        } else {
            $lateness = 0; 
        }
        
        PmDailyTimeRecord::create([
            'interns_id' => $request->input('id'),
            'arrival_pm' => now()->format('H:i:s'),
            'late_pm' => $lateness,
            'date' => now()->format('Y-m-d'),
        ]);
        
        return response()->json(['success' => 'Successfully timed in arrival']);
    }

    public function timeOutPM($id){

        $timeLog = PmDailyTimeRecord::findOrFail($id);
        $timeLog->departure_pm = now()->format('H:i:s');
        $timeLog->save();

        return response()->json(['success'=>"Successfully Timed out"]);

        // Check if there's an existing time out entry for today
        
    }
}