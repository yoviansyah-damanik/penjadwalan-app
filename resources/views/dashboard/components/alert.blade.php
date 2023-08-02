<div class="mb-3">
    @if (Session::get('store_success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ __(':feature was successfully created.', ['feature' => Session::get('alert_feature')]) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::get('update_success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ __(':feature was successfully updated.', ['feature' => Session::get('alert_feature')]) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::get('delete_success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ __(':feature was successfully deleted.', ['feature' => Session::get('alert_feature')]) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::get('exception_alert'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ Session::get('alert_msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
