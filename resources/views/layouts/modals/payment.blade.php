<div class="modal modal--small" id="modal-payment">
    <div class="modal__inner">
        <div class="modal__window" style="text-align: center">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <h3 class="modal__title">Підписка</h3>
            <h4>Ціна: <span id="paymentPlanPrice"></span></h4>
            <form id="paymentForm" method="POST" action="" accept-charset="utf-8" style="margin-top: 20px; display: none">
                <input type="hidden" name="data" value=""/>
                <input type="hidden" name="signature" value=""/>
                <input type="image"
                       src="//static.liqpay.ua/buttons/payUk.png"/>
            </form>
        </div>
    </div>
</div>
