@extends('dashboard.layouts.app')

@section('title', __(':create Create', ['create' => __('Timetable')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('timetable.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start">{{ __('Start') }}</label>
                            <input type="time" name="start" class="form-control" value="{{ old('start') }}">
                            @error('start')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end">{{ __('End') }}</label>
                            <input type="time" name="end" class="form-control" value="{{ old('end') }}">
                            @error('end')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="color">{{ __('Color') }}</label>
                            <input type="color" name="color" class="form-control" value="{{ old('color', $color) }}">
                            @error('color')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':create Create', ['create' => __('Timetable')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
