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
            <header class="bookmarks-section__header">
                <h1 class="page-title bookmarks-section__title">Реєстр</h1>
            </header>
            <ul class="bookmarks-section__list">
                @foreach($registries as $registry)
                    <li data-zone="folder_{{$registry->id}}" class="folder_container bookmarks-section__item">
                        <div class="bookmark-card">
                            <a class="drag_element bookmark-card__link" href="{{ $registry->link }}" target="_blank">
                                <div class="bookmark-card__pic">
                                    <svg class="bookmark-card__icon" width="110" height="86">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#folder-solid')}}"></use>
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
