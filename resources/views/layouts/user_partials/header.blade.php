<header class="header {{ $is_menu_hidden ? 'is-full' : '' }}">
    <div class="container header__container">
        <button class="burger header__burger" type="button" aria-label="Open sidebar" aria-expanded="false" data-sidebar-toggle="data-sidebar-toggle">
            <div class="burger__line"></div>
            <div class="burger__line"></div>
            <div class="burger__line"></div>
        </button>
        <a class="button header__button" href="{{ route('user.articles.index') }}">Модуль КК</a>
        <a class="button button--outline header__button" href="{{ route('user.articles.index') }}">Модуль КПК</a>
        <form class="search header__search" id="search-form" autocomplete="off" novalidate="novalidate">
            <div class="search__group">
                <input class="input search__input" id="inputSearch" type="text" name="inputSearch" placeholder="Пошук по збірнику" autocomplete="off" required="required"/>
                <button class="search__button">
                    <svg class="search__icon" width="21" height="21">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                    </svg>
                </button>
            </div>
        </form>
        <ul class="actions header__actions">
            <li class="actions__item is-dropdown actions__item--hidden-md">
                <button class="button button--outline actions__button is-dropdown__toggle" type="button" aria-label="Show dropdown menu">
                    <svg class="button__icon" width="21" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#bell')}}"></use>
                    </svg>
                </button>
                <ul class="actions-dropdown">
                    <li class="actions-dropdown__item">
                        <div class="notification-card">
                            <time class="notification-card__date">27.11.2023</time>
                            <div class="notification-card__info">
                                <h3 class="notification-card__title">Кримінальне процесуальне законодавство України</h3><a class="button button--outline notification-card__more" href="#">
                                    <svg class="button__icon" width="17" height="12">
                                        <use xlink:href="{{('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                    </svg></a>
                            </div>
                        </div>
                    </li>
                    <li class="actions-dropdown__item">
                        <div class="notification-card">
                            <time class="notification-card__date">27.11.2023</time>
                            <div class="notification-card__info">
                                <h3 class="notification-card__title">Кримінальне процесуальне законодавство України</h3><a class="button button--outline notification-card__more" href="#">
                                    <svg class="button__icon" width="17" height="12">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                    </svg></a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="actions__count">2</div>
            </li>
            <li class="actions__item is-dropdown actions__item--visible-md">
                <button class="button button--outline actions__button" type="button" aria-label="Show notifications modal" data-modal="modal-notifications">
                    <svg class="button__icon" width="21" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#bell')}}"></use>
                    </svg>
                </button>
                <div class="actions__count">2</div>
            </li>
            <li class="actions__item actions__item--hidden-md">
                <a class="button actions__button actions__button--big" href="{{ route('subscription') }}">Моя підписка</a>
            </li>
            <li class="actions__item actions__item--visible-md">
                <button class="button button--outline actions__button" type="button" data-modal="modal-search" aria-label="Show search modal">
                    <svg class="button__icon" width="21" height="21">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                    </svg>
                </button>
            </li>
            <li class="actions__item">
                <a class="button button--outline actions__button" href="{{ route('logout') }}" aria-label="Logout">
                    <svg class="button__icon" width="24" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#logout')}}"></use>
                    </svg></a>
            </li>
        </ul>
    </div>
</header>
