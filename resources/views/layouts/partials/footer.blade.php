<footer class="footer">
    <div class="container footer__container">
        <div class="footer__col footer__col--3">
            <div class="logo footer__logo">
                <a class="logo__link" href="#" aria-label="logo">
                    <img class="logo__img" src="{{ asset('assets/img/logo.png') }}" srcset="{{ asset('assets/img/logo@2x.png') }} 2x" width="101" height="73" alt="logo"/>
                </a>
            </div>
            <ul class="payment footer__payment">
                <li class="payment__item">
                    <svg class="payment__icon" width="25" height="8">
                        <use xlink:href="/assets/img/sprite.svg#visa"></use>
                    </svg>
                </li>
                <li class="payment__item">
                    <svg class="payment__icon" width="23" height="14">
                        <use xlink:href="/assets/img/sprite.svg#mastercard"></use>
                    </svg>
                </li>
                <li class="payment__item">
                    <svg class="payment__icon" width="30" height="7">
                        <use xlink:href="/assets/img/sprite.svg#liqpay"></use>
                    </svg>
                </li>
            </ul>
        </div>
        <div class="footer__col footer__col--5">
            <nav class="footer-menu">
                <ul class="footer-menu__list">
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="/#tariffs-section">Тарифи</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('blog.index') }}">Блог</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('contacts') }}">Контакти</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('policy') }}">Політика конфіденційності</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('offer') }}">Оферта</a>
                    </li>
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('about') }}">Про нас</a>
                    </li>
                    <li class="mobile-nav-menu__item" style="flex-direction: row;">
                        @guest
                        <a class="button button--outline mobile-nav-menu__button" href="{{ route('login') }}">Вхід</a>
                        @endguest
                        <a class="button button--app mobile-nav-menu__button" href="{{ \App\Services\SettingService::getValueByName(\App\Enums\SettingEnum::APPLE_STORE_URL->value) }}">
                            <svg class="button__icon" width="78" height="22">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#app-store') }}"></use>
                            </svg></a><a class="button button--app mobile-nav-menu__button" href="{{ \App\Services\SettingService::getValueByName(\App\Enums\SettingEnum::GOOGLE_STORE_URL->value) }}">
                            <svg class="button__icon" width="85" height="21">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#google-play') }}"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="footer__col footer__col--4">
            <div class="footer__info">
                <div class="footer__copyright">{{ \App\Services\SettingService::getValueByName(\App\Enums\SettingEnum::FOOTER_TEXT->value) }}</div>
                <div class="footer__dev">Розроблено<a class="footer__dev-link" href="https://shafem.com/"
                                                      target="_blank"><img class="footer__dev-img" src="/assets/img/shafem.svg"
                                                                           width="95" height="20"
                                                                           alt="Shafem logo"/></a></div>
            </div>
            <a class="button button--outline up-button" href="#main" data-scroll="data-scroll">
                <svg class="up-button__icon" width="20" height="10">
                    <use xlink:href="/assets/img/sprite.svg#arrow-top"></use>
                </svg>
            </a>
        </div>
    </div>
</footer>




