@extends('dashboard.layouts.app')

@section('title', __(':edit Edit', ['edit' => __('Timetable')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('timetable.update', $timetable->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $timetable->title) }}">
                            @error('title')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start">{{ __('Start') }}</label>
                            <input type="time" name="start" class="form-control"
                                value="{{ old('start', Carbon::parse($timetable->start)->format('H:i')) }}">
                            @error('start')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end">{{ __('End') }}</label>
                            <input type="time" name="end" class="form-control"
                                value="{{ old('end', Carbon::parse($timetable->end)->format('H:i')) }}">
                            @error('end')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="color">{{ __('Color') }}</label>
                            <input type="color" name="color" class="form-control"
                                value="{{ old('color', $timetable->color, $color) }}">
                            @error('color')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ old('description', $timetable->description) }}">
                            @error('description')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':edit Edit', ['edit' => __('Timetable')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
