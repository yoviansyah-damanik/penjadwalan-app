@extends('dashboard.layouts.app')

@section('title', __('Print :print', ['print' => __('Schedule')]))

@section('content')
    <div class="alert alert-primary">
        <h4 class="alert-heading">{{ __('Information') }}</h4>
        <p>{{ __('The system will only load the monthly schedule.') }}</p>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('print.schedule.print') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="month">{{ __('Month') }}</label>
                            <select name="month" id="month" class="form-select">
                                @foreach (GeneralHelper::get_months() as $idx => $month)
                                    <option value="{{ $idx + 1 }}" @if ($idx + 1 == date('m')) selected @endif>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">{{ __('Year') }}</label>
                            <select name="year" id="year" class="form-select">
                                @foreach (range(date('Y'), 2023) as $year)
                                    <option value="{{ $year }}" @if ($year == date('Y')) selected @endif>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
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
