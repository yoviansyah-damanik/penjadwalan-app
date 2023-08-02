<!DOCTYPE html>
<html>

<head>
    <style>
        html {
            font-size: 10pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 1cm;
        }

        h5 {
            font-size: 1.2em;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-bolder {
            font-weight: bolder;
        }

        .font-lighter {
            font-weight: lighter;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        table {
            width: 100%;
        }

        table thead {
            vertical-align: middle;
        }

        table.bordered {
            margin-top: 1rem;
            border-collapse: collapse;
        }

        table.bordered th {
            text-align: center;
        }

        table.bordered td,
        table.bordered th {
            border: 1px solid #607080;
            padding: 3px;
        }

        table.bordered th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #d9fcef;
        }

        table.bordered td {
            vertical-align: top;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break-inside-avoid {
            page-break-inside: avoid;
        }

        .logo {
            position: relative;
            width: 150px;
        }
    </style>
</head>

<body>
    <img src="{{ asset('dashboard-assets/images/logo/logo.png') }}" alt="Logo" class="logo">
    <h5 class="text-center">
        {{ __('Accumulation of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) }}
    </h5>

    <table class="bordered">
        <thead>
            <tr>
                <th rowspan=2 width=40px>#</th>
                <th rowspan=2 width=250px>{{ __('Officer Name') }}</th>
                <th colspan=5>{{ __('Total Attendance') }}</th>
            </tr>
            <tr>
                @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                    <th>{{ $status['abb'] }}</th>
                @endforeach
                <th>{{ __('Amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officers as $officer)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $officer->name }}</td>
                    @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                        <td class="text-center">
                            {{ $officer->schedules()->where('date', '>=', $start_date->format('Y-m-d'))->where('date', '<=', $end_date->format('Y-m-d'))->get()->sum(function ($q) use ($status) {
                                    return $q->attendance_record()
                                        ?->{Str::camel($status['name'])}()->count() ?? 0;
                                }) }}
                        </td>
                    @endforeach
                    <td class="text-center">
                        {{ $officer->schedules()->where('date', '>=', $start_date->format('Y-m-d'))->where('date', '<=', $end_date->format('Y-m-d'))->get()->sum(function ($q) use ($status) {
                                return $q->attendance_record()?->count() ?? 0;
                            }) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <th class="text-end" colspan=2>
                    {{ __('Total') }}
                </th>
                @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                    <th class="text-center">
                        {{ $officers->sum(function ($q) use ($start_date, $end_date, $status) {
                            return $q->schedules()->where('date', '>=', $start_date->format('Y-m-d'))->where('date', '<=', $end_date->format('Y-m-d'))->get()->sum(function ($q) use ($status) {
                                    return $q->attendance_record()
                                        ?->{Str::camel($status['name'])}()->count() ?? 0;
                                });
                        }) }}
                    </th>
                @endforeach
                <th class="text-center">
                    {{ $officers->sum(function ($q) use ($start_date, $end_date, $status) {
                        return $q->schedules()->where('date', '>=', $start_date->format('Y-m-d'))->where('date', '<=', $end_date->format('Y-m-d'))->get()->sum(function ($q) use ($status) {
                                return $q->attendance_record()?->count() ?? 0;
                            });
                    }) }}
                </th>
            </tr>
        </tbody>
    </table>

    <table class="bordered text-center page-break-inside-avoid"
        style="width:270px; margin-left:auto; margin-top: 20px;">
        <tr>
            <th colspan=2>{{ __('Explanation') }}</th>
        </tr>
        @foreach (\App\Models\AttendanceRecord::STATUS as $status)
            <tr>
                <td width=40px>{{ $status['abb'] }}</td>
                <td>{{ __(Str::headline($status['name'])) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>-</td>
            <td>{{ __('No Schedule/No Absence') }}</td>
        </tr>
    </table>
</body>

</html>
