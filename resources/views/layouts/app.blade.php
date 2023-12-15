<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>
    <meta name="lang" content="{{ app()->getLocale() }}">
    <link rel="stylesheet" href=" {{ asset('assets/styles/main.css') }}">
    @stack('scripts_head')
    @stack('style')
</head>
<body>
@include('layouts.partials.header')
@yield('page')
@include('layouts.partials.footer')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('scripts_footer')
</body>
</html>
