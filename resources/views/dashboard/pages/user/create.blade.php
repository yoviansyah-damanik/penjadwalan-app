@extends('dashboard.layouts.app')

@section('title', __(':create Create', ['create' => __('User')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                            @error('username')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="officer">{{ __('Officer') }}</label>
                            <select name="officer" id="officer" class="form-select">
                                @foreach ($officers as $officer)
                                    <option value="{{ $officer->slug }}">{{ $officer->name }}</option>
                                @endforeach
                            </select>
                            @error('officer')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="re_password">{{ __('Re-Password') }}</label>
                            <input type="password" name="re_password" class="form-control"
                                value="{{ old('re_password') }}">
                            @error('re_password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':create Create', ['create' => __('User')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
