@extends('dashboard.layouts.app')

@section('title', __('Attendance Report'))

@section('content')
    <div class="alert alert-primary">
        <h4 class="alert-heading">{{ __('Information') }}</h4>
        <p>{{ __('The system will only load scheduling reports for a maximum of 7 days.') }}</p>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('attendance-report.print') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type">{{ __('Type') }}</label>
                            <select name="type" id="type" class="form-select">
                                <option value="1">{{ __('Recap') }}</option>
                                <option value="2">{{ __('Accumulation') }}</option>
                            </select>
                            @error('type')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="year">{{ __('Year') }}</label>
                            <select name="year" id="year" class="form-select">
                                @foreach (range(2023, date('Y')) as $year)
                                    <option value="{{ $year }}" @if (old('year', date('Y')) == $year) selected @endif>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                            @error('year')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="month">{{ __('Month') }}</label>
                            <select name="month" id="month" class="form-select">
                                @foreach (GeneralHelper::get_months() as $idx => $month)
                                    <option value="{{ $idx + 1 }}" @if (old('month', date('m')) == $idx + 1) selected @endif>
                                        {{ $month }}</option>
                                @endforeach
                            </select>
                            @error('month')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button class="btn btn-primary">
                                {{ __('Print') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
