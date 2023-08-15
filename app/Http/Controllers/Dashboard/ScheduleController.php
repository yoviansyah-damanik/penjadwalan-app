<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\Officer;
use App\Models\Schedule;
use App\Models\Timetable;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ScheduleRequest;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $schedules = new Schedule();
        if ($type == 'today')
            $schedules = $schedules->date(date('Y-m-d'));
        elseif ($type == 'next_7_days')
            $schedules = $schedules->where('date', '>=', date('Y-m-d'))
                ->where('date', '<=', Carbon::now()->addDays(7)->format('Y-m-d'));
        elseif ($type == 'this_week')
            $schedules = $schedules->where('date', '>=', Carbon::now()->startOfWeek()->addDays(-1)->format('Y-m-d'))
                ->where('date', '<=', Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d'));

        $schedules = $schedules->paginate(15);
        return view('dashboard.pages.schedule.index', compact('schedules', 'type'));
    }

    public function show(Schedule $schedule)
    {
        return view('dashboard.pages.schedule.show', compact('schedule'));
    }

    public function create()
    {
        $officers = Officer::active()
            ->get();
        $areas = Area::get();
        $timetables = Timetable::get();
        return view('dashboard.pages.schedule.create', compact('officers', 'areas', 'timetables'));
    }

    public function store(ScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $dates = Str::of($request->date)->explode(',');

            $dates = $dates->map(function ($q) {
                return Carbon::createFromFormat('d/m/Y', $q);
            });

            $check = $dates->some(function ($q) {
                return $q->lessThan(Carbon::now()->startOfDay());
            });

            if ($check) {
                return back()
                    ->withInput()
                    ->with('exception_alert', true)
                    ->with('alert_msg', __('Invalid date selected.'));
            }

            foreach ($dates as $date) {
                if ($date->lessThan(Carbon::now()->startOfDay()))
                    return back()
                        ->withInput()
                        ->with('exception_alert', true)
                        ->with('alert_msg', __('Invalid date selected.'));

                $check = Schedule::date($date->format('Y-m-d'))
                    ->where('officer_id', $request->officer)
                    ->first();

                if ($check)
                    return back()
                        ->withInput()
                        ->with('exception_alert', true)
                        ->with('alert_msg', __('The officer has been scheduled on the date you selected.'));

                $new_schedule = new Schedule();
                $new_schedule->officer_id = $request->officer;
                $new_schedule->area_id = $request->area;
                $new_schedule->timetable_id = $request->timetable;
                $new_schedule->date = $date;
                $new_schedule->description = $request->description;
                $new_schedule->save();

                $attendance = Attendance::where('date', $date->format('Y-m-d'))
                    ->first();

                if ($attendance) {
                    AttendanceRecord::create([
                        'schedule_id' => $new_schedule->id,
                        'attendance_id' => $attendance->id,
                        'attendance_status' => collect(AttendanceRecord::STATUS)->where('name', 'not_present')->first()['code']
                    ]);
                }
            }

            DB::commit();
            return to_route('schedule')
                ->with('store_success', true)
                ->with('alert_feature', __('Schedule'));
        } catch (Exception $e) {
            DB::rollback();
            return back()
                ->with('exception_alert', true)
                ->with('alert_msg', $e->getMessage());
        } catch (Throwable $e) {
            DB::rollback();
            return back()
                ->with('exception_alert', true)
                ->with('alert_msg', $e->getMessage());
        }
    }

    public function edit(Schedule $schedule)
    {
        if ($schedule->attendance_record)
            return to_route('schedule')
                ->with('exception_alert', true)
                ->with('alert_msg', __('The schedule has been filled registered on attendance.'));

        $officers = Officer::active()
            ->get();
        $areas = Area::get();
        $timetables = Timetable::get();
        return view('dashboard.pages.schedule.edit', compact('schedule', 'officers', 'areas', 'timetables'));
    }

    public function update(Schedule $schedule, ScheduleRequest $request)
    {
        $officer = $schedule->officer->id;
        $date = $request->date;

        $check = Schedule::where([
            'officer_id' => $officer,
            'date' => $date
        ])->first();

        if ($check) {
            return back()
                ->withInput()
                ->with('exception_alert', true)
                ->with('alert_msg', __('The officer has a schedule on that date.'));
        }


        $schedule->area_id = $request->area;
        $schedule->timetable_id = $request->timetable;
        $schedule->date = $request->date;
        $schedule->description = $request->description;
        $schedule->save();

        return to_route('schedule')
            ->with('store_success', true)
            ->with('alert_feature', __('Schedule'));
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->attendance_record)
            return to_route('schedule')
                ->with('exception_alert', true)
                ->with('alert_msg', __('The schedule has been filled registered on attendance.'));

        $schedule->delete();

        return to_route('schedule')
            ->with('delete_success', true)
            ->with('alert_feature', __('Schedule'));
    }
}
