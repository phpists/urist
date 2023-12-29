<div class="modal modal--small" id="modal-bookmark">
    <div class="modal__inner">
      <div class="modal__window">
        <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
          <svg class="modal__close-icon" width="23" height="22">
            <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
          </svg>
        </button>
        <h3 class="modal__title">Додавання позиції до розділу “Закладки”</h3>
        <form class="form modal__form" id="bookmark-form" autocomplete="off" novalidate="novalidate">
            <input id="storeFavArticleId" type="hidden" name="criminal_article_id">
          <div class="form__group">
            <select class="select" id="selectBookmarkFolder" name="selectBookmarkFolder" aria-label="Виберіть папку" required="required">
              <option value="">Виберіть папку</option>
              <option value="1">Папка 1</option>
              <option value="2">Папка 2</option>
              <option value="3">Папка 3</option>
              <option value="4">Папка 4</option>
            </select>
          </div>
          <div class="form__buttons-group form__buttons-group--center">
            <button class="button form__button modal__button">Додати</button>
          </div>
        </form>
      </div>
    </div>
  </div>
