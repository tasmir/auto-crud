@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<link href="{{ asset('assets/fontawesome-6.2.1/css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fontawesome-6.2.1/css/brands.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fontawesome-6.2.1/css/solid.css') }}" rel="stylesheet">
<link href="{{ asset('assets/backend/css/styles.css') }}" rel="stylesheet" />

@stack('before-custom-css')
<link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet" />
@stack('css')
@yield('page-styles')
