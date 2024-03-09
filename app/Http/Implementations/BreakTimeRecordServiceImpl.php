<?php

namespace App\Http\Implementations;

use App\Http\Traits\AuditLogTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BreakTimeRecord;
use App\Http\Services\BreakTimeRecordService;
use Mockery\Generator\StringManipulation\Pass\Pass;
use DateTime;
use DateInterval;

class BreakTimeRecordServiceImpl implements BreakTimeRecordService
{
    use AuditLogTrait;

    public function __construct(){
        date_default_timezone_set('Asia/Manila');
    }

    public function allBreakTIme($userID)
    {
        $break = User::find($userID)->break_time_record;

        return response()->json([
            'break' => $break,
        ]);
    }

    public function addBreakTime(Request $request)
    {
        $current_time = new DateTime();
        $duration_parts = explode(':', $request->duration);
        $hours = $duration_parts[0];
        $minutes = $duration_parts[1];
        $seconds = $duration_parts[2];

        $duration = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");

        $end_time = $current_time->add($duration);

        $time_end = $end_time->format('H:i:s');
        $checkIfAlreadyLoggedAM = BreakTimeRecord::where('date', date('Y-m-d'))
            ->where('users_id', $request->userID)
            ->where('time_period', $request->time_period)
            ->get();
        $checkIfAlreadyLoggedPM = BreakTimeRecord::where('date', date('Y-m-d'))
            ->where('users_id', $request->userID)
            ->where('time_period', $request->time_period)
            ->get();

        if($checkIfAlreadyLoggedAM->count() > 0){
            return response()->json([
                'success' => False,
                'message' => 'You have already had a break this Morning.'
            ], 200);
        }

        if($checkIfAlreadyLoggedPM->count() > 0){
            return response()->json([
                'success' => False,
                'message' => 'You have already had a break this Afternoon.'
            ], 200);
        }

        BreakTimeRecord::create([
            'users_id' => $request->userID,
            'break_type' => $request->break_type,
            'time_period' => $request->time_period,
            'time_started' => date('H:i:s'),
            'time_ended' => $time_end,
            'duration' => $request->duration,
            'date' => date('Y-m-d')
        ]);
        // $this->auditLog($request->userID, $request->break_type);
        return response()->json([
            'success' => True,
            'message' => 'Break Time Recorded Successfully!'
        ]);
    }

}

