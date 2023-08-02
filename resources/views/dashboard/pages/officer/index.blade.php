@extends('dashboard.layouts.app')

@section('title', __('Officers'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <th width=40px>#</th>
                        <th>{{ __('Officer Name') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th width=200px>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($officers as $officer)
                            <tr>
                                <td class="text-center">
                                    {{ $officers->perPage() * ($officers->currentPage() - 1) + $loop->iteration }}</td>
                                </td>
                                <td>
                                    {{ $officer->name }}
                                </td>
                                <td>
                                    {{ $officer->address }}
                                </td>
                                <td class="text-center">
                                    <span class="@if ($officer->status == 'Active') text-success @else text-danger @endif">
                                        {{ __($officer->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: .5rem;">
                                        <a href="{{ route('officer.show', $officer->slug) }}" class="btn btn-sm btn-info">
                                            {{ __('Show') }}
                                        </a>
                                        <a href="{{ route('officer.edit', $officer->slug) }}"
                                            class="btn btn-sm btn-warning">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('officer.destroy', $officer->slug) }}" method="post">
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
                                <td colspan=5 class="text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $officers->links() }}
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
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('Officer')]) }}`,
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
