@extends('dashboard.layouts.app')

@section('title', __('Attendances'))

@section('content')
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
                                {{-- <td>{{ $attendance->records()->notPresent()->count() }}</td>
                                <td>{{ $attendance->records()->permit()->count() }}</td>
                                <td>{{ $attendance->records()->leave()->count() }}</td> --}}
                                <td>{{ $attendance->records()->count() }}</td>
                                <td>{{ $attendance->checker->name }}</td>
                                <td>{{ $attendance->created_at->translatedFormat('d F Y H:i:s') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('attendance.show', $attendance->id) }}"
                                            class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        @if (Carbon::now()->format('Y-m-d') == Carbon::parse($attendance->date)->format('Y-m-d'))
                                            <a href="{{ route('attendance.edit', $attendance->id) }}"
                                                class="btn btn-sm btn-warning">
                                                {{ __('Edit') }}
                                            </a>
                                        @endif
                                        {{-- <form action="{{ route('attendance.destroy', $attendance->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger btn-destroy">
                                                {{ __('Delete') }}
                                            </button>
                                        </form> --}}
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

@push('scripts')
    <script type="text/javascript">
        $('.btn-destroy').on('click', (e) => {
            e.preventDefault()

            Swal.fire({
                title: `{{ __('Confirmation!') }}`,
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('Attendance')]) }}`,
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
