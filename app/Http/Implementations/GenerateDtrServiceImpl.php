<?php

namespace App\Http\Implementations;

use App\Http\Services\GenerateDtrService;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class GenerateDtrServiceImpl implements GenerateDtrService
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
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('templates\iDtr.xlsx'));
        $worksheet = $spreadsheet->getActiveSheet();

        $user = User::find($request->userID)->intern;
        $pm_time = User::find($request->userID)->pm_daily_time_record;
        $am_time = User::find($request->userID)->am_daily_time_record;

        $i = 0;
        $num = 1;
        $startDate = Carbon::parse($request->start_date); // Assuming you have a start_date in your request
        $endDate = Carbon::parse($request->end_date); // Assuming you have a end_date in your request

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
            $worksheet->insertNewRowBefore(13 + $i, 1);
            $worksheet->setCellValue('B' . (12 + $i), $num);
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
            $num++;

        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $fileName = $request->fileName .'.xlsx';
        $filePath = public_path('templates\\' . $fileName);
        $writer->save($filePath);


        $data = [
            'name' => "Gio Dela Peña",
            'email' => "giolagariza@gmail.com"
        ];
        Mail::send(new DTRGenerated($data, $filePath));

        return response()->json([
            'success' => True,
            'message' => 'DTR sent Successfully!'
        ], 200);
    }
}

class DTRGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $filePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $filePath)
    {
        $this->data = $data;
        $this->filePath = $filePath;
        $this->to($data['email']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('dtr.sent')
                    ->subject('DTR Generated')
                    ->attach($this->filePath);
    }
}
