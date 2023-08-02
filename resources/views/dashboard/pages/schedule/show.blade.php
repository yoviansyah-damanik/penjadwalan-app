@extends('dashboard.layouts.app')

@section('title', __('Schedule'))

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>{{ __('Officer Name') }}</th>
                            <td>{{ $schedule->officer->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Area') }}</th>
                            <td>{{ $schedule->area->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Timetable') }}</th>
                            <td>{{ $schedule->timetable->title }}
                                ({{ $schedule->timetable->start }}-{{ $schedule->timetable->end }})</td>
                        </tr>
                        <tr>
                            <th>{{ __('Date') }}</th>
                            <td>{{ Carbon::parse($schedule->date)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Description') }}</th>
                            <td>{{ $schedule->description }}</td>
                        </tr>
                    </table>

                    @if (!$schedule->attendance_record)
                        <div class="d-flex justify-content-center" style="gap: .5rem;">
                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-sm btn-warning">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger btn-destroy">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
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
