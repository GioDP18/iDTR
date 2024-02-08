<?php

namespace App\Http\Controllers;

use App\Models\AmDailyTimeRecord;
use Illuminate\Http\Request;

class AmDailyTimeRecordController extends Controller
{
    public function timeInAM(Request $request){
        $res = AmDailyTimeRecord::create([
            'interns_id' => $request->userID,
            'arrival_am' => date('H:i:s'),
            'date' => date('Y-m-d')
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

    public function timeOutAM(Request $request){
        $res = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('interns_id', $request->userID)->update([
            'departure_am' => date('H:i:s')
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
        // $recordAM = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('interns_id', $request->userID)->get();
        $recordAM = AmDailyTimeRecord::where('date', date('Y-m-d'))->where('interns_id', $request->userID)->get();
        return response()->json([
            'recordAM' => $recordAM,
        ], 200);
    }
}
