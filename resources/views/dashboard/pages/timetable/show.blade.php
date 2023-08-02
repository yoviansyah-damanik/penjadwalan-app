@extends('dashboard.layouts.app')

@section('title', __('Timetable'))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>
                                {{ __('Title') }}
                            </th>
                            <td>
                                {{ $timetable->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Start') }}
                            </th>
                            <td>
                                {{ $timetable->start ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('End') }}
                            </th>
                            <td>
                                {{ $timetable->end ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Color') }}
                            </th>
                            <td>
                                <span class="rounded-circle"
                                    style="display:inline-block;width:15px; aspect-ratio:1/1; background:{{ $timetable->color }}"></span>
                                {{ $timetable->color }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Description') }}
                            </th>
                            <td>
                                {{ $timetable->description ?? '-' }}
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                        <a href="{{ route('timetable.edit', $timetable->slug) }}" class="btn btn-sm btn-warning">
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
