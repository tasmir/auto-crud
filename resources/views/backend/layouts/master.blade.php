<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@stack('title') @yield('title') | {{ env('APP_NAME') }}</title>
    @include('backend.layouts.partials.styles')
</head>

<body class="sb-nav-fixed">
    @include('backend.layouts.partials.topnav')
    <div id="layoutSidenav">
        @include('backend.layouts.partials.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 pt-4">
                    @yield('content')
                </div>
            </main>
            @include('backend.layouts.partials.footer')
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>
