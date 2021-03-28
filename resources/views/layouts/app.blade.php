<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Medyana</title>
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap">
    @stack('styles')
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/xplay.min.css') }}">
</head>
<body>

<div id="page-container" class="page-header-fixed main-content-narrow">

<!-- Header -->
@include('layouts.header')
<!-- Header End -->

@yield('content')

<!-- Footer -->
@include('layouts.footer')
<!-- Footer End -->
</div>

<script src="{{ asset('assets/js/dashmix.core.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
