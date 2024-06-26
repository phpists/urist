<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="lang" content="{{ app()->getLocale() }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('build/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @if(isset($systemPage))
        @include('layouts.partials.seo', ['model' => $systemPage])
    @elseif(isset($blog))
        @include('layouts.partials.seo', ['model' => $blog])
    @endif
    @stack('style')
    @stack('scripts_head')
</head>
<body>
@include('layouts.partials.noscript')
@include('layouts.partials.header')
<div class="modal-wrap">
    @stack('modals')
</div>
<main id="main" class="main">
    @yield('page')
</main>
@include('layouts.partials.footer')
@include('layouts.partials.mobile_nav')
<script type="module" crossorigin src="{{ asset('build/main.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@stack('scripts')
</body>
</html>
