<!DOCTYPE html>
<html>

<head>
    <style>
        html {
            font-size: 8pt;
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

        .valign-middle {
            vertical-align: middle !important;
        }

        .mt-4 {
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <img src="{{ asset('dashboard-assets/images/logo/logo.png') }}" alt="Logo" class="logo">
    <h5 class="text-center">
        {{ __('Recap of Attendance for :month :year', ['month' => $start_date->translatedFormat('F'), 'year' => $year]) }}
    </h5>
    <h5 class="text-center">{{ __('Officer Name') }}: {{ Auth::user()->officer->name }}</h5>

    <table class="bordered">
        <thead class="font-bold">
            <th>{{ __('Numb') }}</th>
            <th>{{ __('Date/Time') }}</th>
            <th>{{ __('Attendance Status') }}</th>
            <th>{{ __('Checker') }}</th>
            <th width=120px>{{ __('Expl') }}</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['date']->translatedFormat('l, d F Y') }}</td>
                    <td>
                        @if ($item['schedule'])
                            {{ $item['schedule']?->attendance_record?->attendanceStatusText ? __(Str::headline($item['schedule']->attendance_record->attendanceStatusText)) : '-' }}
                        @else
                            {{ '-' }}
                        @endif
                    </td>
                    <td>
                        @if ($item['schedule'])
                            {{ $item['schedule']?->attendance?->checker?->name ?? '-' }}
                        @else
                            {{ '-' }}
                        @endif
                    </td>
                    <td>
                        {{-- INFORMATION --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <table class="bordered text-center" style="width:220px !important; margin-left:auto">
            <tr>
                <th colspan=2>{{ __('Explanation') }}</th>
            </tr>
            @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                <tr>
                    <th width=110px>{{ __(Str::headline($status['name'])) }}</th>
                    <td class="valign-middle">
                        {{ ${'attendance_' . $status['name'] . '_count'} }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
