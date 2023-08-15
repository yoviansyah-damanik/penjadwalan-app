<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Officer;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\AttendanceRequest;
use App\Models\AttendanceRecord;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $attendances = new Attendance();
        if ($type == 'last_7_days')
            $attendances = $attendances->where('date', '<=', date('Y-m-d'))
                ->where('date', '>=', Carbon::now()->addDays(-7)->format('Y-m-d'));
        elseif ($type == 'last_14_days')
            $attendances = $attendances->where('date', '<=', date('Y-m-d'))
                ->where('date', '>=', Carbon::now()->addDays(-14)->format('Y-m-d'));
        elseif ($type == 'this_month')
            $attendances = $attendances->where('date', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))
                ->where('date', '<=', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $attendance_present_total = $attendances->clone()->get()->sum(function ($q) {
            return $q->records()->present()->count();
        });
        $attendance_not_present_total = $attendances->clone()->get()->sum(function ($q) {
            return $q->records()->notPresent()->count();
        });
        $attendance_permit_total = $attendances->clone()->get()->sum(function ($q) {
            return $q->records()->permit()->count();
        });
        $attendance_leave_total = $attendances->clone()->get()->sum(function ($q) {
            return $q->records()->leave()->count();
        });

        $attendances = $attendances->paginate(15);

        return view('dashboard.pages.attendance.index', compact(
            'attendances',
            'type',
            'attendance_present_total',
            'attendance_not_present_total',
            'attendance_permit_total',
            'attendance_leave_total'
        ));
    }

    public function show(Attendance $attendance)
    {
        $officers = Officer::with('schedules', 'schedules.attendance_record', 'schedules.officer')
            ->get();

        return view('dashboard.pages.attendance.show', compact('attendance', 'officers'));
    }

    public function create()
    {
        $date = Carbon::now();

        $is_av = Attendance::where('date', $date->format('Y-m-d'))
            ->first();

        if ($is_av)
            return to_route('attendance')
                ->with('exception_alert', true)
                ->with('alert_msg', __('Today\'s absence has been filled. Please check again the attendance data that you have entered.'));

        $officers = Officer::active()
            ->get();

        return view('dashboard.pages.attendance.create', compact('officers', 'date'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $insert_attendance = Attendance::create([
                'checker_id' => Auth::id(),
                'date' => date('Y-m-d')
            ]);

            $attendances = $request->attendance;
            foreach ($attendances as $attendance) {
                AttendanceRecord::create([
                    'attendance_id' => $insert_attendance->id,
                    'schedule_id' => $attendance['schedule'],
                    'attendance_status' => $attendance['attendance_status'],
                ]);
            }

            DB::commit();
            return to_route('attendance')
                ->with('store_success', true)
                ->with('alert_feature', __('Attendance'));
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

        return to_route('attendance')
            ->with('store_success', true)
            ->with('alert_feature', __('Attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $date = Carbon::parse($attendance->date);
        $now = Carbon::now()->startOfDay();

        $officers = Officer::active()
            ->get();

        if ($now->greaterThan($date))
            return to_route('attendance')
                ->with('exception_alert', true)
                ->with('alert_msg', __('The date of filling in the absence has exceeded the specified time limit.'));

        return view('dashboard.pages.attendance.edit', compact('attendance', 'date', 'officers'));
    }

    public function update(Attendance $attendance, Request $request)
    {
        DB::beginTransaction();
        try {
            $attendance->checker_id = Auth::id();
            $attendance->save();

            $attendances = $request->attendance;
            foreach ($attendances as $attendance_) {
                AttendanceRecord::where([
                    'attendance_id' => $attendance->id,
                    'schedule_id' => $attendance_['schedule'],
                ])->update([
                    'attendance_status' => $attendance_['attendance_status'],
                ]);
            }

            DB::commit();
            return to_route('attendance')
                ->with('update_success', true)
                ->with('alert_feature', __('Attendance'));
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

        return to_route('attendance')
            ->with('store_success', true)
            ->with('alert_feature', __('Attendance'));
    }

    // public function destroy(Attendance $attendance)
    // {
    //     $attendance->delete();

    //     return to_route('attendance')
    //         ->with('delete_success', true)
    //         ->with('alert_feature', __('Attendance'));
    // }
}
