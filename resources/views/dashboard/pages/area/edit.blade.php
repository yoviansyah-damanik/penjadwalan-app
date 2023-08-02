@extends('dashboard.layouts.app')

@section('title', __(':edit Edit', ['edit' => __('Officer')]))

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('area.update', $area->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">{{ __('Area Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $area->name) }}">
                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ old('description', $area->description) }}">
                            @error('description')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __(':edit Edit', ['edit' => __('Area')]) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
