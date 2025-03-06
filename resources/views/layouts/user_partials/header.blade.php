<header class="header {{ $is_menu_hidden ? 'is-full' : '' }}">
    <div class="container header__container">
        <a class="button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value)) header__button @else button--outline header__button @endif"
           href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KK_MODULE_BTN->value) }}">Модуль КК</a>
        <a class="button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value)) header__button @else button--outline header__button @endif"
           href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KPK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KPK_MODULE_BTN->value) }}">Модуль КПК</a>
        <a class="button @if(url()->current() == route('user.files.index')) header__button @else button--outline header__button @endif" href="{{ route('user.files.index') }}" aria-label="Кабінет">
            <svg class="sidebar-menu__icon" width="17" height="21">
                <use xlink:href="{{ asset('assets/img/user/sprite.svg#file') }}"></use>
            </svg>Кабінет</a>

        @if(can_user(\App\Enums\PermissionEnum::SMART_SEARCH->value))
        <form class="search header__search articles-search" action="{{ request('type') ? route('user.articles.index', ['type' => request('type')]) : route('user.articles.index') }}" id="search-form" autocomplete="off" novalidate="novalidate">
            <div class="search__group">
                <input class="input search__input" id="inputSearch" type="text" name="search" placeholder="Пошук по базі" autocomplete="off" value="{{ request('search') }}" required="required" data-url="{{ route('user.search.items') }}"/>
                <div class="searchItemsContainer"></div>
                <button class="search__button">
                    <svg class="search__icon" width="21" height="21">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                    </svg>
                </button>
            </div>
        </form>
        @else
            <div class="search header__search">
                <div class="search__group">
                    <input class="input search__input" id="inputSearch" type="text" name="search" placeholder="Пошук недоступний" autocomplete="off" disabled/>
                    <div class="searchItemsContainer"></div>
                    <button class="search__button" disabled>
                        <svg class="search__icon" width="21" height="21">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#search')}}"></use>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <ul class="actions header__actions">
            <li class="actions__item actions__item--visible-md">
                <button class="button button--outline actions__button" type="button" aria-label="Open sidebar" aria-expanded="false" data-modal-once="modal-tip-7" data-sidebar-toggle="data-sidebar-toggle">
                    <svg class="button__icon" width="17" height="17">
                        <use xlink:href="{{ asset('assets/img/user/sprite.svg#settings') }}"></use>
                    </svg>
                </button>
            </li>
            <li class="actions__item actions__item--visible-md">
                <a class="button button--outline actions__button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value) || (isset($article) && $article->type == \App\Enums\CriminalArticleTypeEnum::KK->value)) is-active @endif"
                        href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KK_MODULE_BTN->value) }}" aria-label="KK">КК</a>
            </li>
            <li class="actions__item actions__item--visible-md">
                <a class="button button--outline actions__button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value) || (isset($article) && $article->type == \App\Enums\CriminalArticleTypeEnum::KPK->value)) is-active @endif"
                   href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KPK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KPK_MODULE_BTN->value) }}" aria-label="KПK">КПК</a>
            </li>
            <li class="actions__item actions__item--visible-md">
                <a class="button button--outline actions__button @if(Route::is('user.articles.index')) is-active @endif" href="{{ route('user.articles.last-page') }}" aria-label="List">
                    <svg class="button__icon" width="17" height="12">
                        <use xlink:href="{{ asset('assets/img/user/sprite.svg#list') }}"></use>
                    </svg>
                </a>
            </li>
            <li class="actions__item actions__item--visible-md">
                @if($lastArticleId = \App\Services\UserLastViewService::getArticle())
                    <a class="button button--outline actions__button @if(Route::is('user.articles.show')) is-active @endif"
                       href="{{ route('user.articles.show', $lastArticleId) }}" aria-label="View">
                        <svg class="button__icon" width="17" height="11">
                            <use xlink:href="{{ asset('assets/img/user/sprite.svg#eye') }}"></use>
                        </svg>
                    </a>
                @else
                    <button class="button button--outline actions__button" type="button" aria-label="View" disabled="disabled">
                        <svg class="button__icon" width="17" height="11">
                            <use xlink:href="{{ asset('assets/img/user/sprite.svg#eye') }}"></use>
                        </svg>
                    </button>
                @endif
            </li>
            <li class="actions__item actions__item--visible-md">
                <a class="button button--outline actions__button @if(url()->current() == route('user.files.index')) is-active @endif" href="{{ route('user.files.index') }}" aria-label="Bookmarks">
                    <svg class="button__icon" width="16" height="20">
                        <use xlink:href="{{ asset('assets/img/user/sprite.svg#bookmark') }}"></use>
                    </svg>
                </a>
            </li>
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
            <li class="actions__item actions__item--hidden-md">
                <a class="button button--outline actions__button" href="{{ route('logout') }}" aria-label="Logout">
                    <svg class="button__icon" width="24" height="22">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#logout')}}"></use>
                    </svg></a>
            </li>
        </ul>
        <button class="header__toggle-button" type="button" aria-label="Header toggle" data-header-toggle="data-header-toggle">
            <svg width="12" height="8">
                <use xlink:href="{{ asset('assets/img/user/sprite.svg#dropdown-arrow') }}"></use>
            </svg>
        </button>
    </div>
</header>
