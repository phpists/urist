@extends('layouts.user_app')
@section('title', 'Робота з файлами')
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
                <h1 class="page-title bookmarks-section__title">Робота з файлами</h1>
                <form class="search bookmarks-section__search ajax-form" id="bookmark-search-form" data-target-container="#itemsContainer" autocomplete="off" novalidate="novalidate">
                    <div class="search__group">
                        <input class="input search__input" id="inputBookmarkSearch" type="text" name="files_search" placeholder="Пошук по файлах" autocomplete="off" required="required"/>
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
            <ul class="bookmarks-section__list" id="itemsContainer">
                @include('user.files._items')
            </ul>
        </div>
    </section>
@endsection


<div class="modal-wrap">
    @include('layouts.user_partials.modal-create', ['folder_type' => \App\Enums\FolderType::FILE_FOLDER->value])
    @include('layouts.user_partials.modal-edit', ['folder_type' => \App\Enums\FolderType::FILE_FOLDER->value])
    @include('layouts.user_partials.modal-edit-file')
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
                success: function (response) {
                    throwSuccessToaster(response.message);
                },
                error: function (jqXHR) {
                    throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
                }
            })
        }

        function moveFavourite(folder_id, id) {
            moveItem('/file/move', folder_id, id);
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
