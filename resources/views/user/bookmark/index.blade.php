@extends('layouts.user_app')
@section('title', 'Закладки')
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
                <h1 class="page-title bookmarks-section__title">Закладки</h1>
                <form class="search bookmarks-section__search" id="bookmark-search-form" autocomplete="off" novalidate="novalidate">
                    <div class="search__group">
                        <input class="input search__input" id="inputBookmarkSearch" type="text" name="inputBookmarkSearch" placeholder="Пошук по файлах" autocomplete="off" required="required"/>
                        <button class="search__button">
                            <svg class="search__icon" width="21" height="21">
                                <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                            </svg>
                        </button>
                    </div>
                </form>
                <div class="bookmarks-section__buttons">
                    <a href="{{ route('user.articles.index') }}" class="button button--outline bookmarks-section__button" type="button">Додати статтю</a>
                    <button class="button button--outline bookmarks-section__button" type="button" data-modal="modal-create">Створити папку</button>
                </div>
            </header>
            <ul class="bookmarks-section__list">
                @if(isset($fav_folder))
                    <li data-zone="folder_{{$fav_folder->parent_id}}" data-label="folder_{{$fav_folder->parent_id}}" class="folder_container bookmarks-section__item">
                        <div class="bookmark-card">
                            <a class="bookmark-card__link" href="{{ route('user.bookmarks.index', $fav_folder->parent_id) }}">
                                <div class="bookmark-card__pic">
                                    <svg class="bookmark-card__icon" width="110" height="86">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#folder-solid')}}"></use>
                                    </svg>
                                </div>
                                <h3 class="bookmark-card__title">Повернутись назад</h3>
                            </a>
                        </div>
                    </li>
                @endif
                @foreach($folders as $folder)
                    <li data-zone="folder_{{$folder->id}}" data-label="folder_{{$folder->id}}" class="folder_container bookmarks-section__item">
                        <div class="bookmark-card">
                            <div class="bookmark-card-menu is-dropdown">
                                <button class="bookmark-card-menu__toggle is-dropdown__toggle">
                                    <svg class="non-draggable bookmark-card-menu__toggle-icon" width="4" height="18">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dots')}}"></use>
                                    </svg>
                                </button>
                                <ul class="bookmark-card-menu__dropdown">
                                    <li class="bookmark-card-menu__item"><button type="button" class="bookmark-card-menu__link modal-self-completing"
                                          data-action="{{ route('folder.update', ['folder_id' => $folder->id]) }}" data-json='@json($folder)'
                                          data-modal="modal-edit">Редагувати</button></li>
                                    <li class="bookmark-card-menu__item">
                                        <button type="button" class="bookmark-card-menu__link modal-self-completing" data-action="{{ route('folders.delete', ['folder_id' => $folder->id]) }}" data-modal="modal-delete">Видалити</button>
                                    </li>
                                </ul>
                            </div>
                            <a class="drag_element bookmark-card__link" href="{{ route('user.bookmarks.index', $folder) }}" draggable="true"
                               data-item="folder_{{ $folder->id }}">
                                <div class="bookmark-card__pic">
                                    <svg class="bookmark-card__icon" width="110" height="86">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#folder-solid')}}"></use>
                                    </svg>
                                </div>
                                <h3 class="bookmark-card__title">{{$folder->name}}</h3>
                                <div class="bookmark-card__info">{{ $folder->getFilesCountTitle() }}</div>
                            </a>
                        </div>
                    </li>
                @endforeach
                @foreach($favourites as $favourite)
                    <li class="bookmarks-section__item" data-label="file_{{$favourite->id}}">
                        <div class="bookmark-card">
                            <div class="bookmark-card-menu is-dropdown">
                                <button class="bookmark-card-menu__toggle is-dropdown__toggle">
                                    <svg class="bookmark-card-menu__toggle-icon" width="4" height="18">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dots')}}"></use>
                                    </svg>
                                </button>
                                <ul class="bookmark-card-menu__dropdown">
                                    <li class="bookmark-card-menu__item">
                                        <button type="button" class="bookmark-card-menu__link modal-self-completing" data-action="{{ route('favourites.delete', ['favourite_id' => $favourite->id]) }}" data-modal="modal-delete">Видалити</button>
                                    </li>
                                </ul>
                            </div>
                            <a class="bookmark-card__link drag_element" draggable="true" data-item="file_{{$favourite->id}}" href="{{ route('user.articles.show', $favourite->criminal_article_id) }}">
                                <div class="bookmark-card__pic">
                                    <svg class="bookmark-card__icon" width="110" height="86">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#docx')}}"></use>
                                    </svg>
                                </div>
                                <h3 class="bookmark-card__title">{{$favourite->name}}</h3>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection


<div class="modal-wrap">
    @include('layouts.user_partials.modal-create', ['folder_type' => \App\Enums\FolderType::FAVOURITES_FOLDER->value])
    @include('layouts.user_partials.modal-edit', ['folder_type' => \App\Enums\FolderType::FAVOURITES_FOLDER->value])
    @include('layouts.user_partials.modal-delete')
</div>

@section('scripts_footer')
    <script type="module" src="{{ asset('js/helpers.js') }}"></script>
    <script type="module">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function handleDragEnter(ev) {
            ev.preventDefault()
        }
        function handleDragOver(ev) {
            ev.preventDefault();
        }

        function moveItem(url, folder_id, id) {
            $.ajax({
                url: url,
                method: 'put',
                data: {
                    item_id: id,
                    folder_id: folder_id
                },
                success: function (resp) {
                    console.log(resp)
                }
            })
        }

        function moveFavourite(folder_id, id) {
            moveItem('/favourites/move', folder_id, id);
        }

        function moveFolder(folder_id, id) {
            moveItem('/folder/move', folder_id, id);
        }

        function handleDrop(ev) {
            let item_id = ev.dataTransfer.getData('text/plain');
            if(item_id !== null && ev.currentTarget.dataset.zone !==  item_id) {
                let id = item_id.split('_');
                if(id.length > 1) {
                    if (id[0] === 'file') {
                        let folder_id = ev.currentTarget.dataset.zone.split('_')[1];
                        moveFavourite(folder_id, id[1]);
                    }
                    else if(id[0] === 'folder') {
                        let folder_id = ev.currentTarget.dataset.zone.split('_')[1];
                        moveFolder(folder_id, id[1]);
                    }
                }
                document.querySelector(`*[data-label="${item_id}"]`).remove()
            }
        }
        function handleDragStart(ev) {
            ev.dataTransfer.setData("text/plain", ev.currentTarget.dataset.item);
        }
        document.addEventListener('DOMContentLoaded', function (ev) {
            document.querySelectorAll('.drag_element').forEach((el) => {
                console.log(el)
                el.addEventListener('dragstart', handleDragStart);
            })
            document.querySelectorAll('.folder_container').forEach((el) => {
                el.addEventListener('dragenter', handleDragEnter)
                el.addEventListener('dragover', handleDragOver)
                el.addEventListener('drop', handleDrop)
            })
        })
    </script>
@endsection
