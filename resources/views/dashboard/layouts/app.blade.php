<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @livewireStyles
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('dashboard-assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="app">
        @include('dashboard.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col">
                            <h3>@yield('title')</h3>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="mt-3">
                        @include('dashboard.components.alert')
                        @yield('content')
                    </div>
                </section>
            </div>

            @include('dashboard.components.footer')
        </div>
    </div>
    @include('dashboard.components.js')
</body>

</html>
