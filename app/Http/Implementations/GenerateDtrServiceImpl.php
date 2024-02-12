<?php

namespace App\Http\Implementations;


use Illuminate\Http\Request;
use App\Http\Services\GenerateDtrService;
use App\Models\User;
use Carbon\Carbon;



class GenerateDtrServiceImpl Implements GenerateDtrService
{

    public function __construct() {
    }

    /**
     * generate DTR file to public template
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generate(Request $request)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('templates\iDtr.xlsx'));
        $worksheet = $spreadsheet->getActiveSheet();

        $user = User::find($request->userID)->intern;
        $pm_time = User::find($request->userID)->pm_daily_time_record;
        $am_time = User::find($request->userID)->am_daily_time_record;

        $i=0;
        $startDate = Carbon::parse($request->start_date); // Assuming you have a start_date in your request
        $endDate = $startDate->copy()->addDays(29);

        $worksheet->setCellValue('B5', $user->firstname. ' '. $user->middlename. ' '. $user->lastname);
        $worksheet->setCellValue('B7', 'For the month of '. $startDate->format('F'). ' - ' .$endDate->format('F'));

        while ($startDate <= $endDate) 
        {
            $dateString = $startDate->format('Y-m-d');

            $total_hours_this_day = 0;
            $total_minutes_this_day = 0;
            $work_hours_am = 0;
            $work_hours_pm = 0;
            $work_minutes_am = 0;
            $work_minutes_pm = 0;
            foreach ($am_time as $record){
                if ($record->date == $dateString) {
                    $work_hours_am = Carbon::parse($record->hours_worked_am)->format('H');
                    $work_minutes_am = Carbon::parse($record->hours_worked_am)->format('i');
                    $worksheet->fromArray([Carbon::parse($record->arrival_am)->format('g:i'), Carbon::parse($record->departure_am)->format('g:i')], null, 'C' . (12 + $i));
                }
            }
            foreach ($pm_time as $record){
                if ($record->date == $dateString) {
                    $work_hours_pm = Carbon::parse($record->hours_worked_pm)->format('H');
                    $work_minutes_pm = Carbon::parse($record->hours_worked_pm)->format('i');
                    $worksheet->fromArray([Carbon::parse($record->arrival_pm)->format('g:i'), Carbon::parse($record->departure_pm)->format('g:i')], null, 'E' . (12 + $i));
                }
            }

            $total_hours_this_day = $work_hours_pm + $work_hours_am;
            $total_minutes_this_day = $work_minutes_pm + $work_minutes_am;
            $worksheet->fromArray([$total_hours_this_day, $total_minutes_this_day], null, 'G' . (12 + $i));
            
            

            $startDate->addDay();
            $i++;

        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(public_path('templates\iDtr_result - '. $user->firstname. ' ' . $user->lastname .'.xlsx'));
        // return response()->download(public_path('templates\iDtr_result - '. $user->firstname. ' ' . $user->lastname .'.xlsx'));
        return response()->json(['success'=>'successfully generated']);
    }
    

}
