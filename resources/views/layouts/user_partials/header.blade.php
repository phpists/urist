<header class="header {{ $is_menu_hidden ? 'is-full' : '' }}">
    <div class="container header__container">
        <button class="burger header__burger" type="button" aria-label="Open sidebar" aria-expanded="false" data-sidebar-toggle="data-sidebar-toggle">
            <div class="burger__line"></div>
            <div class="burger__line"></div>
            <div class="burger__line"></div>
        </button>
        <a class="button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value)) header__button @else button--outline header__button @endif" href="{{ get_setting_value_by_name(\App\Enums\SettingEnum::KK_MODULE_BTN->value) }}">Модуль КК</a>
        <a class="button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value)) header__button @else button--outline header__button @endif" href="{{ get_setting_value_by_name(\App\Enums\SettingEnum::KPK_MODULE_BTN->value) }}">Модуль КПК</a>
        <form class="search header__search" action="{{ route('user.articles.search') }}" id="search-form" autocomplete="off" novalidate="novalidate">
            <div class="search__group">
                <input class="input search__input" id="inputSearch" type="text" name="search" placeholder="Пошук по збірнику" autocomplete="off" value="{{ request('search') }}" required="required" data-url="{{ route('user.search.items') }}"/>
                <div class="searchItemsContainer"></div>
                <button class="search__button">
                    <svg class="search__icon" width="21" height="21">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                    </svg>
                </button>
            </div>
        </form>
        <ul class="actions header__actions">
            <li class="actions__item is-dropdown actions__item--hidden-md">
                <button class="button button--outline actions__button is-dropdown__toggle" id="notificationsButton" type="button" aria-label="Show dropdown menu">
                    <svg class="button__icon" width="21" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#bell')}}"></use>
                    </svg>
                </button>
                @php($notificationService = new \App\Services\NotificationService())
                    <ul class="actions-dropdown" id="notificationsContainer" data-read-url="{{ route('user.notifications.bulk-mark-as-read') }}">
                        @foreach($notificationService->getLatest() as $userNotification)
                        <li class="actions-dropdown__item notification-item" data-id="{{ $userNotification->id }}">
                            <div class="notification-card">
                                <time class="notification-card__date">{{ $userNotification->pretty_created_at }}</time>
                                <div class="notification-card__info">
                                    <h3 class="notification-card__title">{{ $userNotification->title }}</h3>
                                    @if($userNotification->url)
                                    <a class="button button--outline notification-card__more" href="{{ $userNotification->url }}" target="_blank">
                                        <svg class="button__icon" width="17" height="12">
                                            <use xlink:href="{{('/assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @php($unreadCount = $notificationService->getUnreadCount())
                    <div id="notificationsCount" class="actions__count" @if($unreadCount < 1) style="display: none" @endif>{{ $unreadCount }}</div>
            </li>
            <li class="actions__item is-dropdown actions__item--visible-md">
                <button class="button button--outline actions__button" id="mobileNotificationsButton" type="button" aria-label="Show notifications modal" data-modal="modal-notifications">
                    <svg class="button__icon" width="21" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#bell')}}"></use>
                    </svg>
                </button>
                @push('modals')
                    @include('layouts.user_partials.modal-notifications')
                @endpush
                <div id="mobileNotificationsCount" class="actions__count" @if($unreadCount < 1) style="display: none" @endif>{{ $unreadCount }}</div>
            </li>
            <li class="actions__item actions__item--hidden-md">
                <a class="button actions__button actions__button--big" href="{{ route('user.subscription.index') }}">Моя підписка</a>
            </li>
            <li class="actions__item actions__item--visible-md">
                @push('modals')
                    @include('layouts.user_partials.modal-search')
                @endpush
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
