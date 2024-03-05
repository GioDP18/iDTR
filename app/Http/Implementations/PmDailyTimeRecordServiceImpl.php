<?php

namespace App\Http\Implementations;

use App\Models\PmDailyTimeRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Services\PmDailyTimeRecordService;
use App\Models\Intern;

class PmDailyTimeRecordServiceImpl implements PmDailyTimeRecordService
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

    public function timeInPM(Request $request){

        $current_time = strtotime(date('H:i:s'));
        $late_time = strtotime('08:00:00');
        $users_id = $request->userID;
        $arrival_pm = date('H:i:s');

        $checkIfAlreadyLogged = PmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->get();
        if($checkIfAlreadyLogged->count() > 0){
            return response()->json([
                'success' => False,
                'message' => 'You have already logged this afternoon.'
            ], 200);
        }

        $checkStatus = Intern::where('users_id', $request->userID)->first();
        if($checkStatus->status == 1){
            return response()->json([
                'success' => False,
                'message' => 'You are currently in work.'
            ], 200);
        }

        $res = PmDailyTimeRecord::create([
            'users_id' => $users_id,
            'arrival_pm' => $arrival_pm,
            'date' => date('Y-m-d')
        ]);

        if ($current_time > $late_time) {
            $late_seconds = $current_time - $late_time;
            $late_hours = floor($late_seconds / 3600);
            $late_minutes = floor(($late_seconds % 3600) / 60);
            $late_seconds = $late_seconds % 60;

            $late_pm = sprintf('%02d:%02d:%02d', $late_hours, $late_minutes, $late_seconds);
            PmDailyTimeRecord::where('id', $res->id)->update([
                'late_pm' => $late_pm
            ]);
        }

        Intern::where('users_id', $request->userID)->update(['status' => 1]);

        if(!$res){
            return response()->json([
                'success' => False
            ], 200);
        }
        return response()->json([
            'success' => True,
            'message' => 'Time In Recorded Successfully!'
        ], 200);
    }

    public function timeOutPM(Request $request){

        $checkStatus = Intern::where('users_id', $request->userID)->first();
        if($checkStatus->status == 0){
            return response()->json([
                'success' => False,
                'message' => 'You are currently not in work.'
            ], 200);
        }

        $checkIfAlreadyLogged = PmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->first();

        if($checkIfAlreadyLogged->departure_pm != NULL){
            return response()->json([
                'success' => False,
                'message' => 'You have already logged this afternoon.'
            ], 200);
        }


        $get = PmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->first();

        $current_time = strtotime(date('H:i:s'));
        $arrival_pm = strtotime($get->arrival_pm);
        $departure_pm = date('H:i:s');

        $seconds = $current_time - $arrival_pm;
        $minutes = floor(($seconds % 3600) / 60);
        $hours = floor($seconds / 3600);
        $seconds = $seconds % 60;

        $hours_worked_pm = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);


        $res = PmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->update([
            'departure_pm' => $departure_pm,
            'hours_worked_pm' => $hours_worked_pm
        ]);
        Intern::where('users_id', $request->userID)->update(['status' => 0]);
        if(!$res){
            return response()->json([
                'success' => False,
                'message' => 'There was an error while logging your Time Out.'
            ], 200);
        }
        return response()->json([
            'success' => True,
            'message' => 'Time Out Recorded Successfully!'
        ], 200);
    }

    public function fetchTimePM(Request $request){
        $recordPM = PmDailyTimeRecord::where('users_id', $request->userID)
                        ->orderBy('id', 'asc')
                        ->get();

        return response()->json([
            'recordPM' => $recordPM,
        ], 200);
    }
}
