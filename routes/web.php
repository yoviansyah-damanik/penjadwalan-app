<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AreaController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\OfficerController;
use App\Http\Controllers\Dashboard\ScheduleController;
use App\Http\Controllers\Dashboard\TimetableController;
use App\Http\Controllers\Dashboard\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
})
    ->name('home');

Route::middleware('guest')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'do_login'])->name('login.do');
        // Route::get('/register', [AuthController::class, 'register'])->name('register');
        // Route::post('/register', [AuthController::class, 'do_register'])->name('register.do');
    });

Route::middleware('auth')
    ->prefix('dashboard')
    ->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [HomeController::class, 'index'])
            ->name('dashboard');

        // Timetable
        Route::as('timetable')
            ->group(function () {
                Route::get('timetable', [TimetableController::class, 'index']);
                Route::get('timetable/create', [TimetableController::class, 'create'])->name('.create');
                Route::post('timetable/create', [TimetableController::class, 'store'])->name('.store');
                Route::get('timetable/edit/{timetable:slug}', [TimetableController::class, 'edit'])->name('.edit');
                Route::put('timetable/edit/{timetable:slug}', [TimetableController::class, 'update'])->name('.update');
                Route::delete('timetable/destroy/{timetable:slug}', [TimetableController::class, 'destroy'])->name('.destroy');
                Route::get('timetable/{timetable:slug}', [TimetableController::class, 'show'])->name('.show');
            });

        // Area
        Route::as('area')
            ->group(function () {
                Route::get('area', [AreaController::class, 'index']);
                Route::get('area/create', [AreaController::class, 'create'])->name('.create');
                Route::post('area/create', [AreaController::class, 'store'])->name('.store');
                Route::get('area/edit/{area:slug}', [AreaController::class, 'edit'])->name('.edit');
                Route::put('area/edit/{area:slug}', [AreaController::class, 'update'])->name('.update');
                Route::delete('area/destroy/{area:slug}', [AreaController::class, 'destroy'])->name('.destroy');
                Route::get('area/{area:slug}', [AreaController::class, 'show'])->name('.show');
            });

        // Officer
        Route::as('officer')
            ->group(function () {
                Route::get('officer', [OfficerController::class, 'index']);
                Route::get('officer/create', [OfficerController::class, 'create'])->name('.create');
                Route::post('officer/create', [OfficerController::class, 'store'])->name('.store');
                Route::get('officer/edit/{officer:slug}', [OfficerController::class, 'edit'])->name('.edit');
                Route::put('officer/edit/{officer:slug}', [OfficerController::class, 'update'])->name('.update');
                Route::delete('officer/destroy/{officer:slug}', [OfficerController::class, 'destroy'])->name('.destroy');
                Route::get('officer/{officer:slug}', [OfficerController::class, 'show'])->name('.show');
            });

        // Schedule
        Route::as('schedule')
            ->group(function () {
                Route::get('schedule', [ScheduleController::class, 'index']);
                Route::get('schedule/create', [ScheduleController::class, 'create'])->name('.create');
                Route::post('schedule/create', [ScheduleController::class, 'store'])->name('.store');
                Route::get('schedule/edit/{schedule:id}', [ScheduleController::class, 'edit'])->name('.edit');
                Route::put('schedule/edit/{schedule:id}', [ScheduleController::class, 'update'])->name('.update');
                Route::delete('schedule/destroy/{schedule:id}', [ScheduleController::class, 'destroy'])->name('.destroy');
                Route::get('schedule/{schedule:id}', [ScheduleController::class, 'show'])->name('.show');
            });

        // Attendance
        Route::as('attendance')
            ->group(function () {
                Route::get('attendance', [AttendanceController::class, 'index']);
                Route::get('attendance/create', [AttendanceController::class, 'create'])->name('.create');
                Route::post('attendance/create', [AttendanceController::class, 'store'])->name('.store');
                Route::get('attendance/edit/{attendance:id}', [AttendanceController::class, 'edit'])->name('.edit');
                Route::put('attendance/edit/{attendance:id}', [AttendanceController::class, 'update'])->name('.update');
                Route::delete('attendance/destroy/{attendance:id}', [AttendanceController::class, 'destroy'])->name('.destroy');
                Route::get('attendance/{attendance:id}', [AttendanceController::class, 'show'])->name('.show');
            });

        // Report
        Route::get('scheduling-report', [ReportController::class, 'scheduling'])->name('scheduling-report');
        Route::post('scheduling-report', [ReportController::class, 'scheduling_report'])->name('scheduling-report.print');
        // Route::post('scheduling-report', [ReportController::class, 'scheduling_check_view'])->name('scheduling-report.print');
        Route::get('attendance-report', [ReportController::class, 'attendance'])->name('attendance-report');
        Route::post('attendance-report', [ReportController::class, 'attendance_report'])->name('attendance-report.print');
    });
