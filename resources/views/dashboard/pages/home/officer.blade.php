@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="dashboard-page">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-0">
                <div class="row">
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Schedule Today') }}
                                        </h5>
                                        <h6>
                                            @if ($today)
                                                {{ $today->area->name }}
                                                <div class="small">
                                                    ({{ Carbon::parse($today->timetable->start)->format('H:i') . '-' . Carbon::parse($today->timetable->end)->format('H:i') }})
                                                </div>
                                            @else
                                                {{ __('No schedule') }}
                                                <br />&nbsp;
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>
                                            {{ __('Attendance Today') }}
                                        </h5>
                                        <h6>
                                            @if ($attendance)
                                                {{ __(Str::headline($attendance->attendanceStatusText)) }}
                                                <div class="small">
                                                    {{ $attendance->created_at->translatedFormat('d/m/Y H:i:s') }}
                                                </div>
                                            @else
                                                {{ __('Attendance has not been entered') }}
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Schedule Tomorrow') }}
                                        </h5>
                                        <h6>
                                            @if ($tomorrow)
                                                {{ $tomorrow->area->name }}
                                                <div class="small">
                                                    ({{ Carbon::parse($tomorrow->timetable->start)->format('H:i') . '-' . Carbon::parse($tomorrow->timetable->end)->format('H:i') }})
                                                </div>
                                            @else
                                                {{ __('No schedule') }}
                                                <br />&nbsp;
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __(':total Total', ['total' => __('Present')]) }}</h5>
                                        <h6>{{ $attendance_present }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __(':total Total', ['total' => __('Not Present')]) }}</h5>
                                        <h6>{{ $attendance_not_present }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __(':total Total', ['total' => __('Permit')]) }}</h5>
                                        <h6>{{ $attendance_permit }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __(':total Total', ['total' => __('Leave')]) }}</h5>
                                        <h6>{{ $attendance_leave }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    {{ __('Next Schedule') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Area') }}</th>
                                            <th>{{ __('Timetable') }}</th>
                                            <th>{{ __('Attendance Status') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr>
                                                    <td>
                                                        {{ $schedules->perPage() * ($schedules->currentPage() - 1) + $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ Carbon::parse($schedule->date)->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>
                                                        {{ $schedule->area->name }}
                                                    </td>
                                                    <td>
                                                        {{ Carbon::parse($schedule->timetable->start)->translatedFormat('H:i') . '-' . Carbon::parse($schedule->timetable->end)->translatedFormat('H:i') }}
                                                    </td>
                                                    <td>
                                                        @if ($schedule->attendance_record)
                                                            {{ __(Str::headline($schedule->attendance_record->attendanceStatusText)) }}
                                                            <div class="small">
                                                                {{ $schedule->attendance_record->created_at->translatedFormat('d/m/Y H:i:s') }}
                                                            </div>
                                                        @else
                                                            {{ __('Attendance has not been entered') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $schedules->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-0 order-lg-1">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('dashboard-assets/images/faces/1.jpg') }}" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="small text-muted fst-italic mb-0">{{ Auth::user()->username }}</h6>
                                <h6 class="small text-muted fst-italic mb-0">{{ Auth::user()->email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-calendar-date-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h5>{{ __('Nearest Schedule') }}
                                </h5>
                                <h6>
                                    @if ($next)
                                        {{ $next->area->name }}
                                        <div class="small">
                                            {{ Carbon::parse($next->date)->translatedFormat('d F Y') }}
                                            <br />
                                            {{ Carbon::parse($next->timetable->start)->format('H:i') . '-' . Carbon::parse($next->timetable->end)->format('H:i') }}
                                        </div>
                                    @else
                                        {{ __('No schedule') }}
                                        <br />&nbsp;
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
