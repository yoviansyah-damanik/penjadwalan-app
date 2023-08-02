<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Area;
use App\Models\Officer;
use App\Models\Schedule;
use App\Models\Timetable;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $area = Area::count();
        $officer = Officer::count();
        $timetable = Timetable::count();
        $schedule = Schedule::count();
        $attendance = Attendance::count();

        return view('dashboard.index', compact('area', 'officer', 'timetable', 'schedule', 'attendance'));
    }
}
