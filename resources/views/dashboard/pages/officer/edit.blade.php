@extends('dashboard.layouts.app')

@section('title', __(':edit Edit', ['edit' => __('Officer')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('officer.update', $officer->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">{{ __('Officer Name') }}</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $officer->name) }}">
                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $officer->address) }}">
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
                                    <option value="{{ $status }}" @if (old('status', $officer->status) == $status) selected @endif>
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
                                {{ __(':edit Edit', ['edit' => __('Officer')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
