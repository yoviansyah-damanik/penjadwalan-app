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
    </style>
</head>

<body>
    <img src="{{ asset('dashboard-assets/images/logo/logo.png') }}" alt="Logo" class="logo">
    <h5 class="text-center">
        {{ __('Schedule & Location of Security Tasks R-17 Marancar Area Power House Period :d1 - :d2', [
            'd1' => Carbon::parse($start_date)->translatedFormat('d F Y'),
            'd2' => Carbon::parse($end_date)->translatedFormat('d F Y'),
        ]) }}
    </h5>

    <table class="bordered">
        <thead class="font-bold">
            <tr>
                <th width=30px rowspan=2>No</th>
                <th width=160px rowspan=2>Area Tugas</th>
                <th colspan={{ $period->count() }}>Hari/Tanggal</th>
                <th width=90px rowspan=2>Ket</th>
            </tr>
            <tr>
                @foreach ($period as $date)
                    <th>
                        {{ $date->dayName }}<br />
                        ({{ $date->format('d/m/Y') }})
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $area)
                <tr>
                    <td rowspan={{ $area['total_column'] > 0 ? $area['total_column'] : 1 }} class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td rowspan={{ $area['total_column'] > 0 ? $area['total_column'] : 1 }}>
                        {{ $area['name'] }}
                    </td>
                    @foreach ($period as $date)
                        <td style="background-color:{{ $area['timetable'][0]['color'] ?? '#fff' }}">
                            {{ $area['timetable'][0]['schedules'][$date->format('Y-m-d')][0]['officer'] ?? '' }}
                        </td>
                    @endforeach
                    <td>
                        {{-- EXPLANATION TEXT --}}
                    </td>
                </tr>
                @if ($area['total_column'] > 1)
                    @foreach (range(0, $area['total_column'] - 1) as $range)
                        @if (isset($area['timetable'][$range]))
                            @foreach (range($range == 0 ? 1 : 0, $area['timetable'][$range]['total_column'] - 1) as $range_)
                                <tr>
                                    @foreach ($period as $date)
                                        <td
                                            style="background-color:{{ $area['timetable'][$range]['color'] ?? '#fff' }}">
                                            {{ $area['timetable'][$range]['schedules'][$date->format('Y-m-d')][$range_]['officer'] ?? '' }}
                                        </td>
                                    @endforeach
                                    <td>
                                        {{-- EXPLANATION TEXT --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="bordered page-break-inside-avoid" style="width:270px; margin-left:auto; margin-top: 20px;">
        <tr class="text-center">
            <th colspan=2>{{ __('Explanation') }}</th>
        </tr>
        @foreach ($timetables as $timetable)
            <tr>
                <td width=70px style="background-color:{{ $timetable->color }}"></td>
                <td>
                    {{ $timetable->title }}
                    @if ($timetable->start)
                        ({{ Carbon::parse($timetable->start)->format('H:i') }}-{{ Carbon::parse($timetable->end)->format('H:i') }})
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
