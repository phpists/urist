<div class="modal" id="modal-period">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <div class="modal__content">
                <h3 class="modal__title modal__title--mb-20">Оберіть термін продовження підписки</h3>
                <ul class="tariffs-list modal__tariffs-list">
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button is-active" type="button">На місяць</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button">На пів року</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button">На рік</button>
                    </li>
                </ul>
                <div class="modal__price">Вартість 8$</div>
                <button class="button modal__button" type="button">Обрати</button>
            </div>
        </div>
    </div>
</div>
