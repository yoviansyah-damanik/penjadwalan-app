@extends('dashboard.layouts.app')

@section('title', __('Attendances'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <div class="btn-group mb-0" role="group" aria-label="Basic example">
                    <a type="button" href="{{ route('attendance', ['type' => 'all']) }}"
                        class="btn @if ($type == 'all' || !$type) btn-primary @else btn-outline-primary @endif">
                        {{ __('All') }}
                    </a>
                    <a type="button" href="{{ route('attendance', ['type' => 'last_7_days']) }}"
                        class="btn @if ($type == 'last_7_days') btn-primary @else btn-outline-primary @endif">
                        {{ __('Last 7 Days') }}
                    </a>
                    <a type="button" href="{{ route('attendance', ['type' => 'last_14_days']) }}"
                        class="btn @if ($type == 'last_14_days') btn-primary @else btn-outline-primary @endif">
                        {{ __('Last 14 Days') }}
                    </a>
                    <a type="button" href="{{ route('attendance', ['type' => 'this_month']) }}"
                        class="btn @if ($type == 'this_month') btn-primary @else btn-outline-primary @endif">
                        {{ __('This Month') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
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
                            <h6>{{ $attendance_present_total }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
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
                            <h6>{{ $attendance_not_present_total }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
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
                            <h6>{{ $attendance_permit_total }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
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
                            <h6>{{ $attendance_leave_total }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th rowspan=2 width=40px>#</th>
                            <th rowspan=2>{{ __('Date') }}</th>
                            <th colspan=5>{{ __('Total Attendance') }}</th>
                            <th rowspan=2>{{ __('Checker') }}</th>
                            <th rowspan=2>{{ __('Time Absence') }}</th>
                            <th rowspan=2 width=200px>{{ __('Action') }}</th>
                        </tr>
                        <tr>
                            @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                                <th>{{ __(Str::headline($status['name'])) }}</th>
                            @endforeach
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr class="text-center">
                                <td class="text-center">
                                    {{ $attendances->perPage() * ($attendances->currentPage() - 1) + $loop->iteration }}
                                </td>
                                </td>
                                <td>{{ Carbon::parse($attendance->date)->translatedFormat('d F Y') }}</td>
                                @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                                    <td>{{ $attendance->records()->{Str::camel($status['name'])}()->count() }}</td>
                                @endforeach
                                <td>{{ $attendance->records()->count() }}</td>
                                <td>{{ $attendance->checker->name }}</td>
                                <td>{{ $attendance->created_at->translatedFormat('d F Y H:i:s') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('attendance.show', $attendance->date) }}"
                                            class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        @if (Carbon::now()->format('Y-m-d') == Carbon::parse($attendance->date)->format('Y-m-d'))
                                            <a href="{{ route('attendance.edit', $attendance->date) }}"
                                                class="btn btn-sm btn-warning">
                                                {{ __('Edit') }}
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=10 class="text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
@endsection
