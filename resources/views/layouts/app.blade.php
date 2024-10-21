<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="lang" content="{{ app()->getLocale() }}">
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/assets/favicon/manifest.json') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('build/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/social.css') }}">
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
    @include('layouts.modals.social')
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
