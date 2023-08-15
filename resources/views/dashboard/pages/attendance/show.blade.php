@extends('dashboard.layouts.app')

@section('title', __('Schedule'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <span class="font-bold">{{ __('Date') }}:</span>
                {{ Carbon::parse($attendance->date)->translatedFormat('d F Y') }}
            </div>
            <div>
                <span class="font-bold">{{ __('Checker') }}:</span>
                {{ $attendance->checker->name }}
            </div>
            <div>
                <span class="font-bold">{{ __('Time Absence') }}:</span>
                {{ $attendance->created_at->translatedFormat('d F Y H:i:s') }}
            </div>
            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead class='text-center'>
                        <tr>
                            <th rowspan=2>#</th>
                            <th rowspan=2>{{ __('Officer Name') }}</th>
                            <th colspan=4>{{ __('Attendance Status') }}</th>
                        </tr>
                        <tr>
                            @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                                <th>{{ __(Str::headline($status['name'])) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($officers as $officer)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $officer->name }}</td>
                                @if ($officer->status == 'Active')
                                    @if (
                                        $officer
                                            ?->schedules()->date($attendance->date)->first())
                                        @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                                            <th class="text-center">
                                                @if (
                                                    $officer
                                                        ?->schedules()->date($attendance->date)->first()?->attendance_record?->attendance_status != null &&
                                                        $officer
                                                            ?->schedules()->date($attendance->date)->first()?->attendance_record?->attendance_status == $status['code']
                                                )
                                                    <i class="bi bi-check"></i>
                                                @else
                                                    <i class="bi bi-dash"></i>
                                                @endif
                                            </th>
                                        @endforeach
                                    @else
                                        <td colspan=4 class="text-center fst-italic small text-muted">
                                            {{ __('Officer has no schedule on this date.') }}
                                        </td>
                                    @endif
                                @else
                                    <td colspan=4 class="text-center fst-italic small text-danger">
                                        {{ __('Officer status is inactive.') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
