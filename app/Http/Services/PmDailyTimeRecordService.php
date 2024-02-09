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

    /** */
    public function timeOutPM($id);
}