@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-page">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Officer') }}</h5>
                                        <h6>{{ $officer }}</h6>
                                    </div>
                                </div>
                                <a href="{{ route('officer') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Area') }}</h5>
                                        <h6>{{ $area }}</h6>
                                    </div>
                                </div>
                                <a href="{{ route('area') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi bi-calendar2-event"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Timetable') }}</h5>
                                        <h6>{{ $timetable }}</h6>
                                    </div>
                                </div>
                                <a href="{{ route('timetable') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi bi-calendar-range-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                        <h5>{{ __('Schedule') }}</h5>
                                        <h6>{{ $schedule }}</h6>
                                    </div>
                                </div>
                                <a href="{{ route('schedule') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
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
                                <a href="{{ route('attendance') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
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
                                <a href="{{ route('attendance') }}" class="stretched-link"></a>
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
                                        <h5>{{ __(':total Total', ['total' => __('Permit')]) }}</h5>
                                        <h6>{{ $attendance_permit }}</h6>
                                    </div>
                                </div>
                                <a href="{{ route('attendance') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
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
                                <a href="{{ route('attendance') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                                            <th>{{ __('Officer') }}</th>
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
                                                        {{ $schedule->officer->name }}
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
            <div class="col-lg-3">
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
                        <a href="{{ route('account') }}" class="stretched-link"></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                    <i class="bi bi-calendar-range-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h5>{{ __('Schedule Today') }}</h5>
                                <h6>{{ $schedule_today }}</h6>
                            </div>
                        </div>
                        <a href="{{ route('schedule', ['type' => 'today']) }}" class="stretched-link"></a>
                    </div>
                </div>
                @if ($filled_attendance)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h5>{{ __(':t Today', ['t' => __('Present')]) }}</h5>
                                    <h6>{{ $attendance_present_today }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('attendance.show', date('Y-m-d')) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h5>{{ __(':t Today', ['t' => __('Not Present')]) }}</h5>
                                    <h6>{{ $attendance_not_present_today }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('attendance.show', date('Y-m-d')) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h5>{{ __(':t Today', ['t' => __('Permit')]) }}</h5>
                                    <h6>{{ $attendance_permit_today }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('attendance.show', date('Y-m-d')) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h5>{{ __(':t Today', ['t' => __('Leave')]) }}</h5>
                                    <h6>{{ $attendance_leave_today }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('attendance.show', date('Y-m-d')) }}" class="stretched-link"></a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h5>{{ __('Attendance Today') }}</h5>
                                    <h6>{{ __('You have not filled in today\'s attendance') }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('attendance.create') }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
