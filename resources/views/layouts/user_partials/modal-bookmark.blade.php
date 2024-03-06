<div class="modal modal--small" id="modal-bookmark">
    <div class="modal__inner">
      <div class="modal__window">
        <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
          <svg class="modal__close-icon" width="23" height="22">
            <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
          </svg>
        </button>
        <h3 class="modal__title">Додавання позиції до розділу “Закладки”</h3>
        <form action="{{ route('criminal_articles.favourites.add') }}" method="POST" class="form modal__form" id="bookmark-form" autocomplete="off" novalidate="novalidate">
            @csrf
            <input id="storeFavArticleId" type="hidden" name="criminal_article_id">
          <div class="form__group">
            <select class="select" id="selectBookmarkFolder" name="folder_id" aria-label="Виберіть папку" required="required">
              <option value="0">Без додавання папки</option>
                @foreach(Auth::user()->bookmarkFolders as $bookmarkFolder)
                    <option value="{{ $bookmarkFolder->id }}">{{ $bookmarkFolder->getParentBreadcrumbs() }}</option>
                @endforeach
            </select>
          </div>
          <div class="form__buttons-group form__buttons-group--center">
            <button class="button form__button modal__button">Додати</button>
          </div>
        </form>
      </div>
    </div>
  </div>
