<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Officer;
use \PDF;
use App\Models\Timetable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;

class ReportController extends Controller
{
    public function scheduling()
    {
        return view('dashboard.pages.report.scheduling');
    }

    public function scheduling_report(Request $request)
    {
        $request->validate(
            [
                'start_date' => 'required|date|date_format:"Y-m-d"',
                'end_date' => 'required|date|date_format:"Y-m-d"|after:start_date|beforeOrEqual:' . Carbon::parse($request->start_date)->addDays(6),
            ],
            [],
            [
                'start_date' => __('Start Date'),
                'end_date' => __('End Date'),
            ]
        );

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $period = CarbonPeriod::since($start_date)->until($end_date);
        $timetables = Timetable::get();

        $date_period = [];
        foreach ($period as $date) {
            $date_period[] = $date->format('Y-m-d');
        }

        $data = Area::get()
            ->map(function ($q) use ($date_period, $timetables) {
                return [
                    'name' => $q->name,
                    'timetable' => $timetables->map(function ($r) use ($q, $date_period) {
                        return collect([
                            'title' => $r->title,
                            'color' => $r->color,
                            'schedules' => $q->schedules
                                ->whereIn('date', $date_period)
                                ->where('timetable_id', $r->id)
                                ->map(function ($s, $key) use ($q) {
                                    return collect([
                                        'date' => $s->date,
                                        'officer' => $s->officer->name,
                                    ]);
                                })
                                ->groupBy('date'),
                            'total_column' => $q->schedules
                                ->whereIn('date', $date_period)
                                ->where('timetable_id', $r->id)
                                ->groupBy('date')
                                ->max(function ($s) {
                                    return $s->count();
                                })
                        ]);
                    })->filter(fn ($r) => $r['total_column'] > 0)
                        ->values(),
                    'total_column' => $timetables->map(function ($r) use ($q, $date_period) {
                        return collect([
                            'title' => $r->title,
                            'color' => $r->color,
                            'schedules' => $q->schedules
                                ->whereIn('date', $date_period)
                                ->where('timetable_id', $r->id)
                                ->map(function ($s, $key) use ($q) {
                                    return collect([
                                        'date' => $s->date,
                                        'officer' => $s->officer->name,
                                    ]);
                                })
                                ->groupBy('date'),
                            'total_column' => $q->schedules
                                ->whereIn('date', $date_period)
                                ->where('timetable_id', $r->id)
                                ->groupBy('date')
                                ->max(function ($s) {
                                    return $s->count();
                                })
                        ]);
                    })->filter(fn ($r) => $r['total_column'] > 0)
                        ->values()
                        ->sum('total_column')
                ];
            });

        // DATA ORDER LIST
        // 1. AREA
        // 2. TIMETABLE
        // 3. SCHEDULE
        // 4. OFFICER

        // ddd($data);

        $filename = Carbon::now()->timestamp . '_' . __('Schedule and Location Period :d1 - :d2', [
            'd1' => Carbon::parse($start_date)->translatedFormat('d F Y'),
            'd2' => Carbon::parse($end_date)->translatedFormat('d F Y'),
        ]) . '.pdf';

        $pdf = PDF::loadview(
            'printout.scheduling',
            [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'period' => $period,
                'data' => $data,
                'timetables' => $timetables
            ]
        );

        return $pdf->setPaper('A4', 'landscape')
            ->download($filename);

        // return view('printout.scheduling', [
        //     'start_date' => $start_date,
        //     'end_date' => $end_date,
        //     'period' => $period,
        //     'data' => $data,
        //     'timetables' => $timetables
        // ]);
    }

    public function attendance()
    {
        return view('dashboard.pages.report.attendance');
    }

    public function attendance_report(Request $request)
    {
        $request->validate(
            [
                'month' => 'required|numeric|min:1|max:12',
                'year' => 'required|numeric',
                'type' => 'required'
            ],
            [],
            [
                'month' => __('Month'),
                'type' => __('Type'),
                'year' => __('Year')
            ]
        );

        $month = $request->month;
        $year = $request->year;
        $type = $request->type;

        $start_date = Carbon::create($year, $month)->startOfMonth();
        $end_date = $start_date->copy()->endOfMonth();

        $period = CarbonPeriod::since($start_date)->until($end_date);

        $officers = Officer::with('schedules', 'schedules.attendance_record', 'schedules.officer')
            ->get();

        if ($type == 1) {
            $filename = __('Recap of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) . '.pdf';

            $pdf = PDF::loadview(
                'printout.attendance.recap',
                [
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'year' => $year,
                    'period' => $period,
                    'officers' => $officers
                ]
            );

            return $pdf->setPaper('A4', 'landscape')
                ->download($filename);
        } else {
            $filename = __('Accumulation of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) . '.pdf';

            $pdf = PDF::loadview(
                'printout.attendance.accumulation',
                [
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'year' => $year,
                    'officers' => $officers
                ]
            );

            return $pdf->setPaper('A4', 'portrait')
                ->download($filename);
        }
    }

    public function attendance_check_view(Request $request)
    {
        $request->validate(
            [
                'month' => 'required|numeric|min:1|max:12',
                'year' => 'required|numeric',
                'type' => 'required'
            ],
            [],
            [
                'month' => __('Month'),
                'type' => __('Type'),
                'year' => __('Year')
            ]
        );

        $month = $request->month;
        $year = $request->year;
        $type = $request->type;

        $start_date = Carbon::create($year, $month)->startOfMonth();
        $end_date = $start_date->copy()->endOfMonth();

        $officers = Officer::with('schedules', 'schedules.attendance_record', 'schedules.officer')
            ->get();

        if ($type == 1) {
            $filename = __('Recap of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) . '.pdf';

            $period = CarbonPeriod::since($start_date)->until($end_date);

            return view('printout.attendance.recap', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'year' => $year,
                'period' => $period,
                'officers' => $officers
            ]);
        } else {
            $filename = __('Accumulation of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) . '.pdf';

            return view('printout.attendance.accumulation', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'year' => $year,
                'officers' => $officers
            ]);
        }
    }
}
