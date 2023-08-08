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
    <h5 class="text-center">{{ __('Officer Name') }}: {{ Auth::user()->officer->name }}</h5>

    <table class="bordered">
        <thead class="font-bold">
            <th>{{ __('Numb') }}</th>
            <th>{{ __('Date/Time') }}</th>
            <th width=160px>{{ __('Task Area') }}</th>
            <th>{{ __('Timetable') }}</th>
            <th width=120px>{{ __('Expl') }}</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['date']->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $item['schedule']?->area->name ?? '-' }}</td>
                    <td>
                        @if (isset($item['schedule']))
                            {{ Carbon::parse($item['schedule']->timetable->start)->format('H:i') . '-' . Carbon::parse($item['schedule']->timetable->end)->format('H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{-- INFORMATION --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
