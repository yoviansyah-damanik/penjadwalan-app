<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Schedule;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function schedule()
    {
        return view('dashboard.pages.print.schedule');
    }

    public function schedule_print(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $start_date = Carbon::now()->setMonth($month)->setYear($year)->firstOfMonth();
        $end_date = Carbon::now()->setMonth($month)->setYear($year)->endOfMonth();
        $period = CarbonPeriod::since($start_date)->until($end_date);

        $schedules = Schedule::where('officer_id', Auth::user()->officer->id)
            ->where('date', '>=', $start_date)
            ->where('date', '<=', $end_date)
            ->get();

        $data = new Collection();
        foreach ($period as $date) {
            $data->push(
                [
                    'date' => $date,
                    'schedule' => $schedules->where('date', $date->format('Y-m-d'))->first()
                ]
            );
        }

        $filename = Carbon::now()->timestamp . '_' . __('Schedule and Location Period :d1 - :d2', [
            'd1' => Carbon::parse($start_date)->translatedFormat('d F Y'),
            'd2' => Carbon::parse($end_date)->translatedFormat('d F Y'),
        ]) . '_' . Auth::user()->officer->name . '_' . GeneralHelper::get_months()[$month - 1] . '_' . $year . '.pdf';

        $pdf = PDF::loadview(
            'printout.schedule',
            [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'period' => $period,
                'data' => $data
            ]
        );

        return $pdf->setPaper('A4', 'portrait')
            ->download($filename);
    }

    public function attendance()
    {
        return view('dashboard.pages.print.attendance');
    }

    public function attendance_print(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $start_date = Carbon::now()->setMonth($month)->setYear($year)->firstOfMonth();
        $end_date = Carbon::now()->setMonth($month)->setYear($year)->endOfMonth();
        $period = CarbonPeriod::since($start_date)->until($end_date);

        $schedules = Schedule::where('officer_id', Auth::user()->officer->id)
            ->where('date', '>=', $start_date)
            ->where('date', '<=', $end_date)
            ->get();

        $data = new Collection();
        foreach ($period as $date) {
            $data->push(
                [
                    'date' => $date,
                    'schedule' => $schedules->where('date', $date->format('Y-m-d'))->first()
                ]
            );
        }

        $attendance_present_count = $data->sum(function ($q) {
            if ($q['schedule'])
                return $q['schedule']?->attendance_record()->present()->count() ?? 0;
            return 0;
        });
        $attendance_not_present_count = $data->sum(function ($q) {
            if ($q['schedule'])
                return $q['schedule']?->attendance_record()->notPresent()->count() ?? 0;
            return 0;
        });
        $attendance_permit_count = $data->sum(function ($q) {
            if ($q['schedule'])
                return $q['schedule']?->attendance_record()->permit()->count() ?? 0;
            return 0;
        });
        $attendance_leave_count = $data->sum(function ($q) {
            if ($q['schedule'])
                return $q['schedule']?->attendance_record()->leave()->count() ?? 0;
            return 0;
        });

        $filename = __('Recap of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) . '.pdf';

        $pdf = PDF::loadview(
            'printout.attendance',
            [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'period' => $period,
                'year' => $year,
                'data' => $data,
                'attendance_present_count' => $attendance_present_count,
                'attendance_not_present_count' => $attendance_not_present_count,
                'attendance_permit_count' => $attendance_permit_count,
                'attendance_leave_count' => $attendance_leave_count,
            ]
        );

        return $pdf->setPaper('A4', 'portrait')
            ->download($filename);
    }
}
