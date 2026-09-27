<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio - Dashboard</title>

    <!-- Favicon -->
    @if (!empty($siteSetting?->favicon) && file_exists(public_path('uploads/settings/' . $siteSetting->favicon)))
        <link rel="icon" href="{{ asset('uploads/settings/' . $siteSetting->favicon) }}">
    @else
        <!-- Default SVG Fallback -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='22' fill='%230f172a'/><text x='50' y='72' font-family='monospace' font-size='56' fill='%233b82f6' text-anchor='middle'>M</text></svg>">
    @endif

     @include('layouts.admin.styles')

     @stack('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

<!-- Navigation -->
@include('layouts.admin.nav')
<!-- Navigation End -->

@yield('content')
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


  {{-- scripts --}}
  @include('layouts.admin.scripts')
  @stack('scripts')


</body>

</html>
