<div class="modal modal--small" id="modal-payment">
    <div class="modal__inner">
        <div class="modal__window" style="text-align: center">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Ваш платіж обробляється, будь ласка, зачекайте</h3>
            <img src="{{ asset('img/spinner.gif') }}" alt="loading...">
        </div>
    </div>
</div>
