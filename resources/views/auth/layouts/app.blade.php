<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('dashboard-assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="{{ asset('dashboard-assets/images/logo/logo.png') }}"
                                alt="Logo"></a>
                    </div>
                    @yield('content')
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dashboard-assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/app.js') }}"></script>
</body>

</html>
