<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Portfolio Administration">
    <meta name="author" content="Kent-Danielz">

    <title>@yield('title', 'Portfolio - Login')</title>

    <!-- Favicon -->
    @if (!empty($siteSetting?->favicon) && file_exists(public_path('uploads/settings/' . $siteSetting->favicon)))
        <link rel="icon" href="{{ asset('uploads/settings/' . $siteSetting->favicon) }}">
    @else
        <!-- Default SVG Fallback -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='22' fill='%230f172a'/><text x='50' y='72' font-family='monospace' font-size='56' fill='%233b82f6' text-anchor='middle'>M</text></svg>">
    @endif

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('assets/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('assets/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

</head>

<body>

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu -->
    <script src="{{ asset('assets/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- SB Admin 2 JavaScript -->
    <script src="{{ asset('assets/dist/js/sb-admin-2.js') }}"></script>
    
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

</body>

</html>