@extends('dashboard.layouts.app')

@section('title', __('Area'))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>
                                {{ __('Area Name') }}
                            </th>
                            <td>
                                {{ $area->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Description') }}
                            </th>
                            <td>
                                {{ $area->description }}
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-center" style="gap: .5rem;">
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
