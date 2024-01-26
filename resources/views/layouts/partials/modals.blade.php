<div class="modal-wrap">
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
    <div class="modal" id="modal-review">
        <div class="modal__inner">
            <div class="modal__window">
                <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                    <svg class="modal__close-icon" width="23" height="22">
                        <use xlink:href="/assets/img/sprite.svg#close-modal"></use>
                    </svg>
                </button>
                <div class="review-card modal__review-card">
                    <div class="review-card__header">
                        <h3 class="review-card__name">Іван Іванов</h3>
                        <time class="review-card__date">21.11.2023</time>
                    </div>
                    <div class="rating review-card__rating" data-rating="4">
                        <div class="rating__item"></div>
                        <div class="rating__item"></div>
                        <div class="rating__item"></div>
                        <div class="rating__item"></div>
                        <div class="rating__item"></div>
                    </div>
                    <div class="review-card__body">
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                        <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                            юридичних ресурсів?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal--video" id="modal-video">
        <div class="modal__inner">
            <div class="modal__window">
                <button class="modal__close modal__close--outside" aria-label="Close modal"
                        data-modal-close="data-modal-close" type="button">
                    <svg class="modal__close-icon" width="23" height="22">
                        <use xlink:href="/assets/img/sprite.svg#close-modal"></use>
                    </svg>
                </button>
                <div class="modal__video">
                    <iframe id="youtube-video" width="960" height="540"
                            src="https://www.youtube.com/embed/CIpOxa5hxOw?showinfo=0" frameborder="0"
                            allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
