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
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('build/main.css') }}">
    @stack('style')
    @stack('scripts_head')
</head>
<body>
@include('layouts.user_partials.header')
<main id="main" class="main">
    @yield('page')
    <aside class="sidebar">
        <div class="sidebar__panel">
            <div class="sidebar__inner">
                <div class="logo sidebar__logo"><a class="logo__link" href="#" aria-label="logo">
                        <svg class="logo__img" width="38" height="32">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#logo')}}"></use>
                        </svg><span class="logo__title">Збірник</span></a></div>
                <nav class="sidebar-menu">
                    <ul class="sidebar-menu__list">
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link is-active" href="{{route('profile')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="17" height="19">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#user')}}"></use>
                </svg></span><span class="sidebar-menu__title">Мій профіль</span></a></li>
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="{{route('collection')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="22" height="18">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#book')}}"></use>
                </svg></span><span class="sidebar-menu__title">Збірник</span></a></li>
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="{{route('favourites')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="16" height="20">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                </svg></span><span class="sidebar-menu__title">Закладки</span></a></li>
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="{{route('edit_page')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="17" height="21">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#file')}}"></use>
                </svg></span><span class="sidebar-menu__title">Робота з файлами</span></a></li>
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="#"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="21" height="17">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#folder')}}"></use>
                </svg></span><span class="sidebar-menu__title">Реєстри</span></a></li>
                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="{{route('subscription')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="20" height="19">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#subscribe')}}"></use>
                </svg></span><span class="sidebar-menu__title">Моя підписка</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </aside>
</main>
<script type="module" crossorigin src="{{ asset('build/main.js')}}"></script>
@yield('scripts_footer')
</body>
</html>
