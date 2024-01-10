@extends('layouts.user_app')
@section('title', 'Редагування файлу')
@section('page')
    <section class="page-section">
        <div class="container page-section__container">
            <header class="page-section__header">
                <div class="page-section__descr">
                    <a href="{{ url()->previous() }}" class="button button--outline page-section__back-button" type="button" aria-label="Back" data-tooltip="Назад">
                        <svg class="button__icon" width="10" height="19">
                            <use xlink:href="{{ asset('assets/img/sprite.svg#arrow-left') }}"></use>
                        </svg>
                    </a>
                    <div class="page-section__info">
                        <h1 class="page-title page-section__title">{{ $article->name }}</h1>
                        <a class="blue-link page-section__link" href="{{ $article->court_decision_link }}" target="_blank">Посилання на рішення </a>
                    </div>
                </div>
                <ul class="actions page-section__actions">
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button"
                                aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark"
                            data-json='@json(['criminal_article_id' => $article->id])'>
                            <svg class="button__icon" width="19" height="24">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#bookmark') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button" aria-label="Add page" data-tooltip="Робота з файлом" data-json='@json(['criminal_article_id' => $article->id, 'name' => $article->name])' data-modal="modal-file">
                            <svg class="button__icon" width="22" height="24">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#create') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати" onclick="copyText('{{ route('user.articles.show', $article) }}')">
                            <svg class="button__icon" width="22" height="22">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#copy') }}"></use>
                            </svg>
                        </button>
                    </li>
                </ul>
            </header>
            <div class="page-section__text">
                <p><strong class="blue-color">{!! $article->content !!}</strong></p>
            </div>
        </div>
    </section>
@endsection

<div class="modal-wrap">
    @include('layouts.user_partials.modal-bookmark')
    @include('layouts.user_partials.modal-file')
</div>
