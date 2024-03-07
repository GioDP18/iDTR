<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface ReportService {

    public function __construct();
    
    public function allReport(Request $request);

    public function createReport(Request $request);
    
    public function updateReport(Request $request);
    
}
