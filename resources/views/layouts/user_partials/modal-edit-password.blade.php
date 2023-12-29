<div class="modal" id="modal-edit-password">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Редагувати пароль</h3>
            <form class="form modal__form" id="edit-password-form" autocomplete="off" novalidate="novalidate">
                <div class="form__group">
                    <input class="input form__input" id="inputEditPassword" type="password" name="inputEditPassword" placeholder="Старий пароль" autocomplete="off" required="required"/>
                </div>
                <div class="form__group">
                    <input class="input form__input" id="inputEditNewPassword" type="password" name="inputEditNewPassword" placeholder="Новий пароль" autocomplete="off" required="required"/>
                </div>
                <div class="form__group">
                    <input class="input form__input" id="inputEditRepeatPassword" type="password" name="inputEditRepeatPassword" placeholder="Повторити пароль" autocomplete="off" required="required"/>
                </div>
                <div class="form__buttons-group form__buttons-group--center">
                    <button class="button form__button modal__button">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
</div>
