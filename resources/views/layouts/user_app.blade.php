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
    @yield('meta')
    @if(isset($systemPage))
        @include('layouts.partials.seo', ['model' => $systemPage])
    @endif
    <link rel="stylesheet" href="{{ asset('user/build/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/styles.css') }}">
    @stack('style')
    @stack('scripts_head')
</head>
<body>
@include('layouts.partials.noscript')

@php($is_menu_hidden = isset($is_menu_hidden) ? $is_menu_hidden : true)

@include('layouts.user_partials.header')

<main id="main" class="main main--pt-0 {{ $is_menu_hidden ? 'is-full' : '' }}">
    @yield('page')
    @include('layouts.user_partials.sidebar')
</main>

<div class="modal-wrap">
    @stack('modals')
    @include('layouts.user_partials.welcome-hints')
</div>

<div id="alertsContainer">
    @foreach(['success', 'error'] as $alertType)
        @if(session()->has($alertType))
            <span class="{{ $alertType }}">{{ session()->get($alertType) }}</span>
        @endif
    @endforeach
</div>
<img id="spinner" src="{{ asset('img/spinner.gif') }}" alt="loading..." style="display: none">

@include('user.articles.filter._filter', ['type' => request('type', 'kpk')])

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="module" crossorigin src="{{ asset('user/build/main.js')}}"></script>
<script src="{{ asset('user/js/scripts.js')}}"></script>
@yield('scripts_footer')
@stack('scripts')
</body>
</html>
