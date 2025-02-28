@extends('layouts.user_app')
@section('title', $systemPage->title ?? '')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@php($is_menu_hidden = false)

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/social.css') }}">
@endpush

@section('page')
    <style>
        .collection-descr__text p {
            margin-bottom: 0!important;
        }
    </style>
    <section class="collection-section collection-section--pt-0">
        <div class="container collection-section__container">
            <header class="collection-section__sticky-header">
                <div class="filter-toggle collection-section__filter-toggle">
                    <h3 class="filter-toggle__title">Фільтр</h3>
                    <button class="button button--outline filter-toggle__button" type="button" aria-label="Hide Filter" data-filter-toggle="data-filter-toggle">
                        <svg class="button__icon" width="20" height="20">
                            <use xlink:href="{{ asset('img/sprite.svg#filter') }}"></use>
                        </svg>
                    </button>
                </div>
                <form class="sort-form collection-section__sort-form" id="sort-form" autocomplete="off" novalidate="novalidate">
                    <div class="sort-form__group">
                        <select class="select" id="selectSortBy" name="selectSortBy" aria-label="Sort by" required="required">
                            <option value="hierarchy" @selected(request('sort', 'hierarchy') == 'hierarchy')>Сортувати за ієрархією судових рішень (ВП ВС, ОП ККС ВС, ККС ВС) та хронологією</option>
                            <option value="date" @selected(request('sort', 'hierarchy') == 'date')>Сортувати за зростанням</option>
                        </select>
                    </div>
                </form>
            </header>

            <div id="itemsContainer">
                @include('user.articles._items')
            </div>

        </div>
    </section>
@endsection

@push('modals')
    @include('layouts.user_partials.modal-bookmark')
    @include('layouts.user_partials.modal-file')
    @include('layouts.modals.social')
@endpush
