@extends('layouts.user_app')
@section('title', 'Збірник')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@php($is_menu_hidden = false)

@section('page')
    <section class="collection-section">
        <div class="container collection-section__container">
            @if(request()->has('search'))
            <h1 class="page-title collection-section__title">Результати за запитом: "{{ request('search') }}"</h1>
            @endif
            <div class="filter-toggle">
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
                        <option value="created_at:asc">Сортувати за зростанням</option>
                        <option value="created_at:desc">Сортувати за спаданням</option>
                    </select>
                </div>
            </form>

            <div id="itemsContainer">
                @include('user.articles._items')
            </div>

        </div>
    </section>
@endsection

<div class="modal-wrap">
    @include('layouts.user_partials.modal-bookmark')
    @include('layouts.user_partials.modal-file')
</div>
