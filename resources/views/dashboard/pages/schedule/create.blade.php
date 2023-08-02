@extends('dashboard.layouts.app')

@section('title', __(':create Create', ['create' => __('Schedule')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('schedule.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="officer">{{ __('Officer') }}</label>
                            <select name="officer" id="officer" class="form-select">
                                @foreach ($officers as $officer)
                                    <option value="{{ $officer->id }}" @if ($officer->id == old('officer')) selected @endif>
                                        {{ $officer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('officer')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="area">{{ __('Area') }}</label>
                            <select name="area" id="area" class="form-select">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if ($area->id == old('area')) selected @endif>
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
                                    <option value="{{ $timetable->id }}" @if ($timetable->id == old('timetable')) selected @endif>
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
                            <input type="text" class="form-control date-multiple" name="date" id="date"
                                value="{{ old('date') }}" readonly>
                            @error('date')
                                <div class="small text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" class="form-control" name="description" id="description"
                                value="{{ old('description') }}">
                            @error('description')
                                <div class="small text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':create Create', ['create' => __('Schedule')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        console.log(new Date())
        $('.date-multiple').datepicker({
            multidate: true,
            language: 'id',
            startDate: new Date()
        })
    </script>
@endpush
