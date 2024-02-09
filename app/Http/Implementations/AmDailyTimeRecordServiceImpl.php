<?php

namespace App\Http\Implementations;

use App\Models\AmDailyTimeRecord;
use App\Models\Intern;
use Illuminate\Http\Request;
use App\Http\Services\AmDailyTimeRecordService;


class AmDailyTimeRecordServiceImpl implements AmDailyTimeRecordService
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

    public function timeInAM(Request $request){

        $current_time = strtotime(date('H:i:s'));
        $late_time = strtotime('08:00:00');
        $users_id = $request->userID;
        $arrival_am = date('H:i:s');

        $checkIfAlreadyLogged = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->get();
        if($checkIfAlreadyLogged->count() > 0){
            return response()->json([
                'success' => False,
                'message' => 'You have already logged this morning'
            ], 200);
        }

        $checkStatus = Intern::where('users_id', $request->userID)->first();
        if($checkStatus->status == 1){
            return response()->json([
                'success' => False,
                'message' => 'You are currently in work.'
            ], 200);
        }

        $res = AmDailyTimeRecord::create([
            'users_id' => $users_id,
            'arrival_am' => $arrival_am,
            'date' => date('Y-m-d')
        ]);

        if ($current_time > $late_time) {
            $late_seconds = $current_time - $late_time;
            $late_hours = floor($late_seconds / 3600);
            $late_minutes = floor(($late_seconds % 3600) / 60);
            $late_seconds = $late_seconds % 60;

            $late_am = sprintf('%02d:%02d:%02d', $late_hours, $late_minutes, $late_seconds);
            AmDailyTimeRecord::where('id', $res->id)->update([
                'late_am' => $late_am
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

    public function timeOutAM(Request $request){

        $checkStatus = Intern::where('users_id', $request->userID)->first();
        if($checkStatus->status == 0){
            return response()->json([
                'success' => False,
                'message' => 'You are currently not in work.'
            ], 200);
        }

        $checkIfAlreadyLogged = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->first();

        if($checkIfAlreadyLogged->count() > 1 || $checkIfAlreadyLogged->departure_am != NULL){
            return response()->json([
                'success' => False,
                'message' => 'You have already logged this morning.'
            ], 200);
        }


        $get = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->first();

        $current_time = strtotime(date('H:i:s'));
        $arrival_am = strtotime($get->arrival_am);
        $departure_am = date('H:i:s');

        $seconds = $current_time - $arrival_am;
        $minutes = floor(($seconds % 3600) / 60);
        $hours = floor($seconds / 3600);
        $seconds = $seconds % 60;

        $hours_worked_am = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);


        $res = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->update([
            'departure_am' => $departure_am,
            'hours_worked_am' => $hours_worked_am
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

    public function fetchTimeAM(Request $request){
        $recordAM = AmDailyTimeRecord::where('users_id', $request->userID)
                        ->orderBy('id', 'asc')
                        ->get();

        return response()->json([
            'recordAM' => $recordAM,
        ], 200);
    }


}
