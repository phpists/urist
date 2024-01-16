@extends('layouts.user_app')
@section('title', 'Реєстр')
@section('styles')
    <style>
        a.non-draggable, svg.non-draggable, img.non-draggable {
            -webkit-user-drag: none;
            user-select: none;
        }
    </style>
@endsection
@section('page')
    <section class="bookmarks-section">
        <div class="container bookmarks-section__container">
            <div class="filter-toggle">
                <h3 class="filter-toggle__title">Фільтр</h3>
                <button class="button button--outline filter-toggle__button" type="button" aria-label="Hide Filter" data-filter-toggle="data-filter-toggle">
                    <svg class="button__icon" width="20" height="20p">
                        <use xlink:href="img/sprite.svg#filter"></use>
                    </svg>
                </button>
            </div>
            <header class="bookmarks-section__header">
                <h1 class="page-title bookmarks-section__title">Реєстр</h1>
            </header>
            <ul class="bookmarks-section__list">
                @foreach($registries as $registry)
                    <li data-zone="folder_{{$registry->id}}" class="folder_container bookmarks-section__item">
                        <div class="bookmark-card">
                            <a class="drag_element bookmark-card__link" href="{{ $registry->link }}" target="_blank">
                                <div class="bookmark-card__pic">
                                    <svg class="bookmark-card__icon" width="90" height="77">
                                        <use xlink:href="img/sprite.svg#case"></use>
                                    </svg>
                                </div>
                                <h3 class="bookmark-card__title">{{ $registry->title }}</h3>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection


<div class="modal-wrap">
</div>

@section('scripts_footer')
    <script type="module">
    </script>
@endsection
