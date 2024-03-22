@extends('layouts.user_app')
@section('title', 'Редагування файлу')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor.css') }}">
@endpush

@section('page')
    <section class="page-section">
        <div class="container page-section__container">
            <header class="page-section__header">
                <div class="page-section__descr">
                    <a href="{{ url()->previous() }}" class="button button--outline page-section__back-button" type="button" aria-label="Back" data-tooltip="Назад">
                        <svg class="button__icon" width="10" height="19">
                            <use xlink:href="{{ asset('assets/img/user/sprite.svg#arrow-left') }}"></use>
                        </svg>
                    </a>
                    <div class="page-section__info">
                        <h1 class="page-title page-section__title">{{ $article->name }}</h1>
                        @if($article->date)
                            <time class="page-section__date">{{ $article->pretty_date }}</time>
                        @endif
                        <ul class="page-section__tags">
                            @foreach($article->getTagsArray() as $tag)
                                <li class="page-section__tags-item">{{ $tag }}</li>
                            @endforeach
                        </ul>
                        @if($article->court_decision_link)
                        <a class="blue-link page-section__link" href="{{ $article->court_decision_link }}" target="_blank">Посилання на рішення </a>
                        @endif
                    </div>
                </div>
                <ul class="actions page-section__actions">
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button"
                                aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark"
                            data-json='@json(['criminal_article_id' => $article->id])'>
                            <svg class="button__icon" width="19" height="24">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#bookmark') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button" aria-label="Add page" data-tooltip="Робота з файлом" data-json='@json(['criminal_article_id' => $article->id, 'name' => htmlspecialchars($article->name)])' data-modal="modal-file">
                            <svg class="button__icon" width="22" height="24">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#create') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати" onclick="copyText('{{ route('user.articles.show', $article) }}')">
                            <svg class="button__icon" width="22" height="22">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#copy') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <a href="{{ route('user.articles.export-doc', $article) }}" class="button button--outline actions__button" type="button" aria-label="Word" data-tooltip="Word">
                            <svg class="button__icon" width="18" height="21">
                                <use xlink:href="{{ asset('img/sprite.svg#word-simple') }}"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </header>
            <div class="tabs page-section__tabs" data-tabs="tabs-1" data-active="0">
                <ul class="tabs__nav">
                    <li class="tabs__nav-item">
                        <button class="button button--outline tabs__nav-btn" type="button">ПП</button>
                    </li>
                    <li class="tabs__nav-item">
                        <button class="button button--outline tabs__nav-btn" type="button">Судове рішення</button>
                    </li>
                </ul>
            </div>
            <div class="tabs-content page-section__tabs-content" data-tabs-content="tabs-1">
                <div class="tabs-panel">
                    <div class="page-section__text">
                        {!! $article->pp !!}
                    </div>
                </div>
                <div class="tabs-panel">
                    <div class="page-section__text ck-content">
                        {!! $article->statya_kk !!}
                    </div>
                </div>
            </div>
        </div>
    </section>@endsection

@push('modals')
    @include('layouts.user_partials.modal-bookmark')
    @include('layouts.user_partials.modal-file')
@endpush
