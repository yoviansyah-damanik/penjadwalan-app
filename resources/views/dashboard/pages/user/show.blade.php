@extends('dashboard.layouts.app')

@section('title', __('User'))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>{{ __('Username') }}</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Full Name') }}</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        @if ($user->role_name != 'Administrator')
                            <tr>
                                <th>{{ __('Officer') }}</th>
                                <td>{{ $user->officer->name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Role') }}</th>
                            <td>{{ $user->role_name }}</td>
                        </tr>
                        @if (Session::get('new_password'))
                            <tr>
                                <th>{{ __('New Password') }}</th>
                                <td>{{ Session::get('new_password') }}</td>
                            </tr>
                        @endif
                    </table>
                    @if ($user->role_name != 'Administrator')
                        <div class="d-flex justify-content-center" style="gap: .5rem;">
                            <form action="{{ route('user.forgot-password', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning btn-confirm">
                                    {{ __('Forgot Password') }}
                                </button>
                            </form>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
                text: `{{ __('Are you sure you want to delete the :feature?', ['feature' => __('User')]) }}`,
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

        $('.btn-confirm').on('click', (e) => {
            e.preventDefault()

            Swal.fire({
                title: `{{ __('Confirmation!') }}`,
                text: `{{ __('Are you sure you want to reset the user\'s password?') }}`,
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
    </script>
@endpush
