@extends('dashboard.layouts.app')

@section('title', __('Timetables'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <th width=40px>#</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Start') }}</th>
                        <th>{{ __('End') }}</th>
                        <th>{{ __('Color') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th width=200px>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($timetables as $timetable)
                            <tr>
                                <td class="text-center">
                                    {{ $timetables->perPage() * ($timetables->currentPage() - 1) + $loop->iteration }}</td>
                                </td>
                                <td>
                                    {{ $timetable->title }}
                                </td>
                                <td class="text-center">
                                    {{ $timetable->start ?? '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $timetable->end ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <span class="rounded-circle"
                                        style="display:inline-block;width:15px; aspect-ratio:1/1; background:{{ $timetable->color }}"></span>
                                    {{ $timetable->color }}
                                </td>
                                <td class="text-center">
                                    {{ $timetable->description ?? '-' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('timetable.show', $timetable->slug) }}"
                                            class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        <a href="{{ route('timetable.edit', $timetable->slug) }}"
                                            class="btn btn-sm btn-warning">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('timetable.destroy', $timetable->slug) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger btn-destroy">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=7 class="text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $timetables->links() }}
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
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('Timetable')]) }}`,
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
