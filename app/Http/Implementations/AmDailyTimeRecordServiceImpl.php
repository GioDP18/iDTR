<?php

namespace App\Http\Implementations;

use App\Models\AmDailyTimeRecord;
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
        if(!$res){
            return response()->json([
                'success' => False
            ], 200);
        }
        return response()->json([
            'success' => True
        ], 200);
    }

    public function timeOutAM(Request $request){
        $get = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('users_id', $request->userID)->limit(1)->get();

        $current_time = strtotime(date('H:i:s'));
        echo $get->arrival_am;
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
        if(!$res){
            return response()->json([
                'success' => False
            ], 200);
        }
        return response()->json([
            'success' => True
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
