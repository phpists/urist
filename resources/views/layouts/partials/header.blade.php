<header class="header">
    <div class="container header__container">
        <div class="logo header__logo"><a class="logo__link" href="{{route('home')}}" aria-label="logo">
                <svg class="logo__img" width="46" height="38">
                    <use xlink:href="{{ asset('/assets/img/sprite.svg#logo') }}"></use>
                </svg>
                <span class="logo__title">Збірник</span></a></div>
        <nav class="menu header__menu">
            <ul class="menu__list">
                <li class="menu__item"><a class="menu__link is-active" href="{{route('contacts')}}">Тарифи</a></li>
                <li class="menu__item"><a class="menu__link" href="{{route('contacts')}}">Блог</a></li>
                <li class="menu__item"><a class="menu__link" href="{{route('faq')}}">FAQ</a></li>
                <li class="menu__item"><a class="menu__link" href="{{route('contacts')}}">Контакти</a></li>
            </ul>
        </nav>
        <ul class="actions">
            @guest
                <li class="actions__item actions__item--hidden-md"><a class="button actions__button"
                                                                      href="{{route('register.page')}}">Зареєструватися</a>
                </li>
                <li class="actions__item actions__item--hidden-md"><a class="button button--outline actions__button"
                                                                      href="{{route('login')}}" data-modal="modal-login">Вхід</a></li>
            @endguest
            @auth
                <li class="actions__item actions__item"><a class="button button--outline actions__button"
                                                           href="#">
                        <svg class="button__icon" width="17" height="19">
                            <use xlink:href="assets/img/sprite.svg#user "></use>
                        </svg>
                        <span>Мій профіль</span></a></li>

                    <a href="{{route('logout')}}">1</a>
            @endauth
            <li class="actions__item actions__item--visible-md">
                <button class="burger header__burger" type="button" aria-label="Open mobile menu" aria-expanded="false"
                        data-nav-toggle="data-nav-toggle">
                    <div class="burger__line"></div>
                    <div class="burger__line"></div>
                    <div class="burger__line"></div>
                </button>
            </li>
        </ul>
    </div>
</header>

