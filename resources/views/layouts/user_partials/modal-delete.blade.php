<div class="modal modal--small" id="modal-delete">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title modal__title--mb-20">Ви підтверджуєте видалення?</h3>
            <form action="" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal__buttons">
                    <button class="button modal__button" type="submit">Так</button>
                    <button class="button button--outline modal__button" data-modal-close="data-modal-close" type="button">Ні</button>
                </div>
            </form>
        </div>
    </div>
</div>
