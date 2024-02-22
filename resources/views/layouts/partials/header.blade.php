<header class="header">
    <div class="container header__container">
        <div class="logo header__logo">
            <a class="logo__link" href="/" aria-label="logo">
                <img class="logo__img" src="{{ asset('/assets/img/logo.png') }}" srcset="{{ asset('assets/img/logo@2x.png') }} 2x" width="101" height="73" alt="logo"/>
            </a>
        </div>

        <nav class="menu header__menu">
            <ul class="menu__list">
                <li class="menu__item"><a class="menu__link @if(request()->routeIs('home')) is-active @endif" href="/#tariffs-section">Тарифи</a></li>
                <li class="menu__item"><a class="menu__link @if(request()->routeIs('blog.*')) is-active @endif" href="{{ route('blog.index') }}">Блог</a></li>
                <li class="menu__item"><a class="menu__link @if(request()->routeIs('faq')) is-active @endif" href="{{ route('faq') }}">FAQ</a></li>
                <li class="menu__item"><a class="menu__link @if(request()->routeIs('contacts')) is-active @endif" href="{{ route('contacts') }}">Контакти</a></li>
            </ul>
        </nav>
        <ul class="actions">
            <li class="actions__item actions__item--hidden-md"><a class="button button--app actions__button" href="#">
                    <svg class="button__icon" width="78" height="22">
                        <use xlink:href="{{ asset('assets/img/sprite.svg#app-store') }}"></use>
                    </svg></a></li>
            <li class="actions__item actions__item--hidden-md"><a class="button button--app actions__button" href="#">
                    <svg class="button__icon" width="85" height="21">
                        <use xlink:href="{{ asset('assets/img/sprite.svg#google-play') }}"></use>
                    </svg></a></li>
            @guest
                <li class="actions__item actions__item--hidden-md"><a class="button button--outline actions__button"
                                                                      href="{{route('login')}}" data-modal="modal-login">Вхід</a></li>
            @endguest
            @auth
                <li class="actions__item actions__item"><a class="button button--outline actions__button"
                                                           href="{{route('user.profile.index')}}">
                        <svg class="button__icon" width="17" height="19">
                            <use xlink:href="assets/img/sprite.svg#user "></use>
                        </svg>
                        <span>Мій профіль</span></a></li>
                    <li class="actions__item actions__item">
                            <a class="button button--outline actions__button" href="{{route('logout')}}">
                                <svg fill="currentColor" class="button__icon" width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_220_1078)">
                                        <path d="M21.3116 10.3129H12.6035C12.224 10.3129 11.916 10.0049 11.916 9.62538C11.916 9.24589 12.224 8.9379 12.6035 8.9379H21.3116C21.6911 8.9379 21.9991 9.24589 21.9991 9.62538C21.9991 10.0049 21.6911 10.3129 21.3116 10.3129Z" fill="currentColor" style="fill-opacity:1;"/>
                                        <path d="M17.8748 13.7503C17.6987 13.7503 17.5228 13.6833 17.3889 13.5487C17.1204 13.28 17.1204 12.8446 17.3889 12.5761L20.3406 9.62457L17.3889 6.67291C17.1204 6.40436 17.1204 5.96898 17.3889 5.70044C17.6576 5.43172 18.093 5.43172 18.3616 5.70044L21.7989 9.13783C22.0675 9.40638 22.0675 9.84176 21.7989 10.1103L18.3616 13.5477C18.2268 13.6833 18.0509 13.7503 17.8748 13.7503Z" fill="currentColor" style="fill-opacity:1;"/>
                                        <path d="M7.33316 22C7.13695 22 6.95082 21.9725 6.76485 21.9148L1.2484 20.0769C0.497818 19.8147 0 19.1154 0 18.3335V1.83406C0 0.822988 0.822255 0.000732422 1.83333 0.000732422C2.02937 0.000732422 2.21551 0.0282584 2.40164 0.0859959L7.91792 1.92386C8.66867 2.18603 9.16632 2.88542 9.16632 3.66723V20.1667C9.16632 21.1778 8.34424 22 7.33316 22ZM1.83333 1.37569C1.58123 1.37569 1.37496 1.58197 1.37496 1.83406V18.3335C1.37496 18.5287 1.50604 18.7102 1.69302 18.7753L7.18361 20.6049C7.22306 20.6177 7.27442 20.6251 7.33316 20.6251C7.58526 20.6251 7.79137 20.4188 7.79137 20.1667V3.66723C7.79137 3.47203 7.66028 3.29059 7.47331 3.22547L1.98271 1.39583C1.94327 1.38307 1.89191 1.37569 1.83333 1.37569Z" fill="currentColor" style="fill-opacity:1;"/>
                                        <path d="M13.9774 7.33383C13.5979 7.33383 13.2899 7.02584 13.2899 6.64635V2.52148C13.2899 1.88989 12.7758 1.37563 12.1442 1.37563H1.83201C1.45252 1.37563 1.14453 1.06764 1.14453 0.68815C1.14453 0.30866 1.45252 0.000671387 1.83201 0.000671387H12.1442C13.5348 0.000671387 14.6648 1.13092 14.6648 2.52148V6.64635C14.6648 7.02584 14.3568 7.33383 13.9774 7.33383Z" fill="currentColor" style="fill-opacity:1;"/>
                                        <path d="M12.1452 19.2501H8.47849C8.099 19.2501 7.79102 18.9421 7.79102 18.5626C7.79102 18.1831 8.099 17.8751 8.47849 17.8751H12.1452C12.7767 17.8751 13.2908 17.3609 13.2908 16.7293V12.6044C13.2908 12.2249 13.5988 11.9169 13.9783 11.9169C14.3578 11.9169 14.6658 12.2249 14.6658 12.6044V16.7293C14.6658 18.1198 13.5357 19.2501 12.1452 19.2501Z" fill="currentColor" style="fill-opacity:1;"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_220_1078">
                                            <rect width="22" height="22" fill="currentColor" style="fill-opacity:1;"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Вийти</span>
                            </a>
                    </li>
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

