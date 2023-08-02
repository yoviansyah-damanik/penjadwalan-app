@extends('dashboard.layouts.app')

@section('title', __(':edit Edit', ['edit' => __('Schedule')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('schedule.update', $schedule->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="officer">{{ __('Officer') }}</label>
                            <input type="text" class="form-control" value="{{ $schedule->officer->name }}" readonly>
                            <input type="hidden" class="form-control" name="officer" value="{{ $schedule->officer->id }}">
                        </div>
                        <div class="form-group">
                            <label for="area">{{ __('Area') }}</label>
                            <select name="area" id="area" class="form-select">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if ($area->id == old('area', $schedule->area->id)) selected @endif>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="timetable">{{ __('Timetable') }}</label>
                            <select name="timetable" id="timetable" class="form-select">
                                @foreach ($timetables as $timetable)
                                    <option value="{{ $timetable->id }}" @if ($timetable->id == old('timetable', $schedule->timetable->id)) selected @endif>
                                        {{ $timetable->title }} ({{ $timetable->start }}-{{ $timetable->end }})
                                    </option>
                                @endforeach
                            </select>
                            @error('timetable')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">{{ __('Date') }}</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ old('date', $schedule->date) }}">
                            @error('date')
                                <div class="small text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" class="form-control" name="description" id="description"
                                value="{{ old('description', $schedule->description) }}">
                            @error('description')
                                <div class="small text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':edit Edit', ['edit' => __('Schedule')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
