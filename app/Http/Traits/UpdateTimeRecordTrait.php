<?php
namespace App\Http\Traits;

use App\Models\Intern;

trait UpdateTimeRecordTrait {
    public function updateRecord($id){
        $info = Intern::where('users_id', $id)->first();

        $completed_hours_seconds = $this->timeToSeconds($info->total_hours_worked_am)
            + $this->timeToSeconds($info->total_hours_worked_pm)
            + $this->timeToSeconds($info->completed_hours);

        $target_hours_seconds = $this->timeToSeconds($info->target_hours);
        $remaining_hours_seconds = $target_hours_seconds - $completed_hours_seconds;

        $completed_hours = $this->secondsToTime($completed_hours_seconds);
        $remaining_hours = $this->secondsToTime($remaining_hours_seconds);

        $update = Intern::where('users_id', $id)->update([
            'completed_hours' => $completed_hours,
            'remaining_hours' => $remaining_hours,
            'total_hours_worked_am' => '00:00:00',
            'total_hours_worked_pm' => '00:00:00',
        ]);

        return $update ? true : false;
    }

    private function timeToSeconds($time) {
        list($hours, $minutes, $seconds) = explode(':', $time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    private function secondsToTime($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
