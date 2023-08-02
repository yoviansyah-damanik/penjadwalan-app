@extends('dashboard.layouts.app')

@section('title', __('Areas'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <th width=40px>#</th>
                        <th>{{ __('Area Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th width=200px>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($areas as $area)
                            <tr>
                                <td class="text-center">
                                    {{ $areas->perPage() * ($areas->currentPage() - 1) + $loop->iteration }}</td>
                                </td>
                                <td>
                                    {{ $area->name }}
                                </td>
                                <td class="text-center">
                                    {{ $area->description ?? '-' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('area.show', $area->slug) }}" class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        <a href="{{ route('area.edit', $area->slug) }}" class="btn btn-sm btn-warning">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('area.destroy', $area->slug) }}" method="post">
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
                                <td colspan=4 class="text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $areas->links() }}
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
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('Area')]) }}`,
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
