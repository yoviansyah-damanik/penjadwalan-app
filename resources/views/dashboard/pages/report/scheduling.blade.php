@extends('dashboard.layouts.app')

@section('title', __('Scheduling Report'))

@section('content')
    <div class="alert alert-primary">
        <h4 class="alert-heading">{{ __('Information') }}</h4>
        <p>{{ __('The system will only load scheduling reports for a maximum of 7 days.') }}</p>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('scheduling-report.print') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">{{ __('Start Date') }}</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ __('End Date') }}</label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                value="{{ old('end_date') }}" disabled>
                            @error('end_date')
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

@push('scripts')
    <script type="text/javascript">
        $('#start_date').on('change', () => {
            startDateValue = $('#start_date').val();
            endDateValue = $('#end_date').val();

            newStartDateValue = new Date(startDateValue)

            endDateExe = new Date(newStartDateValue.setDate(newStartDateValue.getDate() + 6))

            newEndDate = endDateExe.getFullYear() +
                '-' +
                ("0" + (endDateExe.getMonth() + 1)).slice(-2) +
                '-' +
                ("0" + endDateExe.getDate()).slice(-2)

            $('#end_date').attr('disabled', false)
                .attr('min', startDateValue)
                .attr('max', newEndDate)

            if (endDateValue <= startDateValue)
                $('#end_date').val(newEndDate)

            if ($('#end_date').val() >= newEndDate)
                $('#end_date').val(newEndDate)
        })
    </script>
@endpush
