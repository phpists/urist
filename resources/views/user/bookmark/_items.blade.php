@foreach($folders as $folder)
    <li data-id="{{ $folder->id }}" data-zone="folder_{{$folder->id}}" data-label="folder_{{$folder->id}}" class="folder_container bookmarks-section__item drag_element">
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
            <a class="bookmark-card__link" href="{{ route('user.bookmarks.index', $folder) }}" draggable="true"
               data-item="folder_{{ $folder->id }}">
                <div class="bookmark-card__pic">
                    <svg class="bookmark-card__icon" width="110" height="86">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#case')}}"></use>
                    </svg>
                </div>
                <h3 class="bookmark-card__title">{{$folder->name}}</h3>
                <div class="bookmark-card__info">{{ $folder->getFilesCountTitle() }}</div>
            </a>
        </div>
    </li>
@endforeach

@foreach($favourites as $favourite)
    <li data-file data-id="{{ $favourite->id }}" class="bookmarks-section__item drag_element" data-label="file_{{$favourite->id}}">
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
            <a class="bookmark-card__link" draggable="true" data-item="file_{{$favourite->id}}" href="{{ route('user.articles.show', $favourite->criminal_article_id) }}">
                <div class="bookmark-card__pic">
                    <svg class="bookmark-card__icon" width="110" height="86">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#proposition')}}"></use>
                    </svg>
                </div>
                <h3 class="bookmark-card__title">{{$favourite->name}}</h3>
            </a>
        </div>
    </li>
@endforeach
