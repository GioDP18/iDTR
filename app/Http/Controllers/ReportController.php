<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;
use App\Http\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(public ReportService $reportService){
    }

    public function allReport(Request $request)
    {
        return $this->reportService->allReport($request);
    }

    public function createReport(Request $request)
    {
        return $this->reportService->createReport($request);
    }

    public function updateReport(Request $request)
    {
        return $this->reportService->updateReport($request);
    }
   
}
