<?php
namespace App\Http\Services;

use Illuminate\Http\Request;

interface PmDailyTimeRecordService {

    /**
     * Undocumented function
     */
    public function __construct();

    /**
     * Undocumented function
     *
     * @return void
     */
    public function timeInPM(Request $request);

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function timeOutPM(Request $request);

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getTimePM(Request $request);
    
}