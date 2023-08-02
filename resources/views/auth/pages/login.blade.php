@extends('auth.layouts.app')

@section('title', 'Login')
@section('content')
    <h1 class="auth-title">{{ __('Log in') }}.</h1>
    <p class="auth-subtitle mb-5">{{ __('Log in with your data that you entered during registration.') }}</p>

    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible show fade">
            @foreach ($errors->all() as $error)
                <div class="text-white">{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::get('msg'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ Session::get('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('login.do') }}" method="post">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="username" class="form-control form-control-xl"
                placeholder="{{ __('Username') }}/Email" value="{{ old('username') }}">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password" class="form-control form-control-xl" placeholder="{{ __('Password') }}">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" name="remember_me" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                {{ __('Remember Me') }}
            </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Log in') }}</button>
    </form>
    {{-- <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}" class="font-bold">
                {{ __('Sign up') }}
            </a>.
        </p>
    </div> --}}
@endsection
