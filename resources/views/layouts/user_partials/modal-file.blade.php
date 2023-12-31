<div class="modal modal--small" id="modal-file">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Робота з файлом</h3>
            <form class="form modal__form" id="file-form" autocomplete="off" novalidate="novalidate">
                <div class="form__group">
                    <input class="input form__input" id="inputFileTitle" type="text" name="inputFileTitle" placeholder="Введіть вашу назву пропозиції" autocomplete="off" required="required"/>
                </div>
                <div class="form__group">
                    <select class="select" id="selectFileFolder" name="selectFileFolder" aria-label="Виберіть папку" required="required">
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
