@extends('dashboard.layouts.app')

@section('title', __('Account'))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.update') }}" method="post" autocomplete="false">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input type="text" name="username" class="form-control"
                                value="{{ old('username', Auth::user()->username) }}">
                            @error('username')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Full Name') }}</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', Auth::user()->name) }}">
                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}">
                            @error('email')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':edit Edit', ['edit' => __('Account')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.new-password') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password">{{ __('Current Password') }}</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">{{ __('New Password') }}</label>
                            <input type="password" name="new_password" class="form-control">
                            @error('new_password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="re_password">{{ __('Re-Password') }}</label>
                            <input type="password" name="re_password" class="form-control">
                            @error('re_password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':edit Edit', ['edit' => __('Password')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
