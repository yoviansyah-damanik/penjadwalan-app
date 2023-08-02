@extends('dashboard.layouts.app')

@section('title', __(':create Create', ['create' => __('Area')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('area.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Area Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
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
                                {{ __(':create Create', ['create' => __('Area')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
