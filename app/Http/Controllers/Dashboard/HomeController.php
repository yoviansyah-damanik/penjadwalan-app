<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Officer;
use App\Models\Schedule;
use App\Models\Timetable;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttendanceRecord;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'Administrator')
            return $this->admin();
        return $this->officer();
    }

    public function admin()
    {
        $schedules = Schedule::where('date', '>=', date('Y-m-d'))
            ->orderBy('date', 'asc')
            ->paginate(15);

        $area = Area::count();
        $officer = Officer::count();
        $timetable = Timetable::count();
        $schedule = Schedule::count();
        $attendance_present = AttendanceRecord::present()->count();
        $attendance_not_present = AttendanceRecord::notPresent()->count();
        $attendance_permit = AttendanceRecord::permit()->count();
        $attendance_leave = AttendanceRecord::leave()->count();

        $schedule_today = Schedule::date(date('Y-m-d'));

        $attendance_present_today = $schedule_today->clone()->whereHas('attendance_record', function ($q) {
            $q->present();
        })->count() ?? 0;
        $attendance_not_present_today = $schedule_today->clone()->whereHas('attendance_record', function ($q) {
            $q->notPresent();
        })->count() ?? 0;
        $attendance_permit_today = $schedule_today->clone()->whereHas('attendance_record', function ($q) {
            $q->permit();
        })->count() ?? 0;
        $attendance_leave_today = $schedule_today->clone()->whereHas('attendance_record', function ($q) {
            $q->leave();
        })->count() ?? 0;

        $schedule_today = $schedule_today->count();

        return view('dashboard.pages.home.admin', compact(
            'area',
            'officer',
            'timetable',
            'schedule',
            'attendance_present',
            'attendance_not_present',
            'attendance_permit',
            'attendance_leave',
            'schedules',
            'attendance_present_today',
            'attendance_not_present_today',
            'attendance_permit_today',
            'attendance_leave_today',
            'schedule_today'
        ));
    }

    public function officer()
    {
        $schedules = Schedule::where('officer_id', Auth::user()->officer->id);

        $attendance_present = $schedules->clone()->whereHas('attendance_record', function ($q) {
            $q->present();
        })->count();
        $attendance_not_present = $schedules->clone()->whereHas('attendance_record', function ($q) {
            $q->notPresent();
        })->count();
        $attendance_permit = $schedules->clone()->whereHas('attendance_record', function ($q) {
            $q->permit();
        })->count();
        $attendance_leave = $schedules->clone()->whereHas('attendance_record', function ($q) {
            $q->leave();
        })->count();

        $today = $schedules->clone()
            ->where('date', date('Y-m-d'))
            ->first();

        $tomorrow = $schedules->clone()
            ->where('date', Carbon::now()->addDays(1)->format('Y-m-d'))
            ->first();

        $attendance = $today?->attendance_record;

        $next = Schedule::where('date', '>', date('Y-m-d'))
            ->first();

        $period = CarbonPeriod::create(Carbon::now()->firstOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        $period = $period->map(function (Carbon $date) {
            return $date->format('Y-m-d');
        });

        $schedules = $schedules
            ->where('date', '>=', date('Y-m-d'))
            ->orderBy('date', 'asc')
            ->paginate(15);

        return view('dashboard.pages.home.officer', compact(
            'today',
            'attendance',
            'attendance_present',
            'attendance_not_present',
            'attendance_permit',
            'attendance_leave',
            'next',
            'tomorrow',
            'schedules'
        ));
    }
}
