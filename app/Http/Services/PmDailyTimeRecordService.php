<?php
namespace App\Http\Services;

use Illuminate\Http\Request;

interface PmDailyTimeRecordService {

    public function __construct();

    public function timeInPM(Request $request);

    public function timeOutPM(Request $request);

    public function fetchTimePM(Request $request);

}
