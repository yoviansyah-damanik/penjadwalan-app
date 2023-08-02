@extends('dashboard.layouts.app')

@section('title', __('Schedules'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <th width=40px>#</th>
                        <th>{{ __('Officer Name') }}</th>
                        <th>{{ __('Area') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th colspan=2>{{ __('Time') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Attendance') }}</th>
                        <th width=200px>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td rowspan=2 class="text-center">
                                    {{ $schedules->perPage() * ($schedules->currentPage() - 1) + $loop->iteration }}</td>
                                </td>
                                <td rowspan=2>
                                    <a href="{{ route('officer.show', $schedule->officer->slug) }}">
                                        {{ $schedule->officer->name }}
                                    </a>
                                </td>
                                <td rowspan=2>
                                    <a href="{{ route('area.show', $schedule->area->slug) }}">
                                        {{ $schedule->area->name }}
                                    </a>
                                </td>
                                <td rowspan=2 class="text-center">
                                    {{ Carbon::parse($schedule->date)->translatedFormat('d F Y') }}
                                </td>
                                <td colspan=2 class="text-center">
                                    {{ $schedule->timetable->title }}
                                </td>
                                <td rowspan=2 class="text-center">
                                    {{ $schedule->description ?? '-' }}
                                </td>
                                <td rowspan=2 class="text-center">
                                    @if ($schedule->attendance_record)
                                        {{ __(Str::headline($schedule->attendance_record->attendanceStatusText)) }}
                                    @else
                                        <i class="bi bi-dash"></i>
                                    @endif
                                </td>
                                <td rowspan=2>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('schedule.show', $schedule->id) }}" class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        @if (!$schedule->attendance_record)
                                            <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                class="btn btn-sm btn-warning">
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger btn-destroy">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>{{ $schedule->timetable->start ?? '-' }}</td>
                                <td>{{ $schedule->timetable->end ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=8 class="text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.btn-destroy').on('click', (e) => {
            e.preventDefault()

            Swal.fire({
                title: `{{ __('Confirmation!') }}`,
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('Schedule')]) }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `{{ __('Yes, delete it!') }}`,
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
    </script>
@endpush
