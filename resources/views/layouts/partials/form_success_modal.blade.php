<div class="modal" id="modal-success">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{ asset('assets/img/sprite.svg#close-modal') }}"></use>
                </svg>
            </button>
            <div class="modal__content">
                <svg class="modal__icon" width="114" height="114">
                    <use xlink:href="{{ asset('assets/img/sprite.svg#success') }}"></use>
                </svg>
                <h3 class="modal__title">Форма відправлена</h3>
                <p class="modal__descr">Наш менеджер зв’яжется с вами</p><a class="button modal__button" href="{{ route('home') }}">На
                    головну</a>
            </div>
        </div>
    </div>
</div>
