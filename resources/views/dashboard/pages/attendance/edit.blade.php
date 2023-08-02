@extends('dashboard.layouts.app')

@section('title', __(':edit Edit', ['edit' => __('Attendance')]))

@section('content')

    <form action="{{ route('attendance.update', $attendance->id) }}" method="post">
        @csrf
        @method('put')
        <h5 class="text-center mb-4">
            {{ __('List of Attendance :date', ['date' => Carbon::parse($date)->translatedFormat('d F Y')]) }}
        </h5>

        <div class="mb-3">
            <div class="input-group">
                <input class="form-control form-control-lg" data-action="search" placeholder="{{ __('Search') }}">
                <button type="button" class="btn btn-danger btn-refresh">
                    {{ __('Refresh') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Attendance') }}
                </button>
            </div>
        </div>

        <div class="row">
            @foreach ($officers as $idx => $officer)
                @if ($officer->officerHasSchedule($date->format('Y-m-d')))
                    <div class="col-lg-6" data-search-target=true data-search="{{ $officer->name }}">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-lg-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="font-bold">
                                            {{ $officer->name }}
                                        </div>
                                        <div class="text-muted small fst-italic">
                                            @if ($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first())
                                                {{ $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->area->name }}
                                                -
                                                {{ $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->title }}
                                                ({{ Carbon::parse($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->start)->format('H:i') }}-{{ Carbon::parse($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->end)->format('H:i') }})
                                            @else
                                                {{ __('No assignments.') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 mt-lg-0" style="width:100%; max-width: 220px">
                                        <div class="form-group mb-0">
                                            <input type="hidden" name="attendance[{{ $officer->id }}][schedule]"
                                                value="{{ $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->id }}">
                                            <select name="attendance[{{ $officer->id }}][attendance_status]"
                                                id="attendance-{{ $officer->id }}" class="form-select">
                                                @foreach (\App\Models\AttendanceRecord::STATUS as $status)
                                                    <option value="{{ $status['code'] }}"
                                                        @if (
                                                            $status['code'] ==
                                                                old(
                                                                    'attendance.' . $officer->id . '.attendance_status',
                                                                    $attendance->records()->where(
                                                                            'schedule_id',
                                                                            $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->id)->first()->attendance_status ?? 0)) selected @endif>
                                                        {{ __(Str::headline($status['name'])) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6" data-search-target=true data-search="{{ $officer->name }}">
                        <div class="card mb-2">
                            <div class="card-body bg-light-secondary">
                                <div class="d-lg-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="font-bold">
                                            {{ $officer->name }}
                                        </div>
                                        <div class="text-muted small fst-italic">
                                            @if ($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first())
                                                {{ $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->area->name }}
                                                -
                                                {{ $officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->title }}
                                                ({{ Carbon::parse($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->start)->format('H:i') }}-{{ Carbon::parse($officer->schedules()->date(Carbon::parse($date)->format('Y-m-d'))->first()->timetable->end)->format('H:i') }})
                                            @else
                                                {{ __('No assignments.') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </form>

@endsection

@push('scripts')
    <script type="text/javascript">
        $('button[type=submit]').on('click', (e) => {
            e.preventDefault()

            Swal.fire({
                title: `{{ __('Confirmation!') }}`,
                text: `{{ __('Are you sure you want to save the :feature?', ['feature' => __('Attendance')]) }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `{{ __('Yes, do it!') }}`,
                cancelButtonText: `{{ __('No, cancel!') }}`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        `{{ __('Wait!') }}`,
                        `{{ __('The process is in progress.') }}`,
                        'success'
                    )
                    e.target.closest('form').submit()
                }
            })
        })

        $('button.btn-refresh').on('click', () => {
            $('[data-action=search]').val('')
            searchItem('')
        })

        $('[data-action=search]').on('keyup', (e) => {
            searchItem($(e.target).val())
        })

        const searchItem = (search) => {
            $.each($('[data-search-target=true]'), (idx, value) => {
                name = $(value).data('search').toLowerCase()

                $(value).hide()
                if (name.indexOf(search) > -1)
                    $(value).show()
            })
        }
    </script>
@endpush
