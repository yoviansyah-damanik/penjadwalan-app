@extends('auth.layouts.app')

@section('title', 'Register')
@section('content')
    <h1 class="auth-title">Sign Up</h1>
    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

    @if ($errors->count() > 0)
        <ul class="text-danger mb-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('register.do') }}" method="post">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="name" class="form-control form-control-xl" placeholder="Name">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="confirm_password" class="form-control form-control-xl"
                placeholder="Confirm Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}" class="font-bold">Log
                in</a>.</p>
    </div>
@endsection
