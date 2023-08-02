@extends('dashboard.layouts.app')

@section('title', __(':create Create', ['create' => __('Officer')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('officer.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Officer Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                            @error('address')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-select">
                                @foreach (\App\Models\Officer::STATUS as $status)
                                    <option value="{{ $status }}" @if (old('status') == $status) selected @endif>
                                        {{ __($status) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':create Create', ['create' => __('Officer')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
