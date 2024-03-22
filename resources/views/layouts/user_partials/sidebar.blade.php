<aside class="sidebar">
    <div class="sidebar__panel">
        <div class="sidebar__inner">
            <div class="logo sidebar__logo">
                <a class="logo__link" href="{{ route('user.dashboard.index') }}" aria-label="logo">
                    <img class="logo__img" src="{{ asset('assets/img/user/logo-white.png') }}"
                         srcset="{{ asset('assets/img/user/logo-white@2x.png') }} 2x" width="82" height="61"
                         alt="logo"/>
                </a>
            </div>
            <nav class="sidebar-menu">
                <ul class="sidebar-menu__list">
                    <li class="sidebar-menu__item">
                        <a class="sidebar-menu__link @if(request()->routeIs('user.profile.index')) is-active @endif"
                           href="{{ route('user.profile.index') }}">
                            <span class="sidebar-menu__pic">
                                <svg class="sidebar-menu__icon" width="17" height="19">
                                  <use xlink:href="{{asset('assets/img/user/sprite.svg#user')}}"></use>
                                </svg>
                            </span>
                            <span class="sidebar-menu__title">Мій профіль</span>
                        </a>
                    </li>
                    @if(request()->user()->can(\App\Enums\PermissionEnum::MODULE_KK->value))
                        <li class="sidebar-menu__item">
                            <a class="sidebar-menu__link @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value)) is-active @endif"
                               href="{{route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value)}}">
                            <span class="sidebar-menu__pic">
                                <svg class="sidebar-menu__icon" width="22" height="18">
                                    <use xlink:href="{{asset('assets/img/user/sprite.svg#hammer')}}"></use>
                                </svg>
                            </span>
                                <span class="sidebar-menu__title">Модуль КК</span>
                            </a>
                        </li>
                    @endif
                    @if(request()->user()->can(\App\Enums\PermissionEnum::MODULE_KPK->value))
                        <li class="sidebar-menu__item">
                            <a class="sidebar-menu__link @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value)) is-active @endif"
                               href="{{route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value)}}">
                            <span class="sidebar-menu__pic">
                                <svg class="sidebar-menu__icon" width="22" height="18">
                                    <use xlink:href="{{asset('assets/img/user/sprite.svg#hammer')}}"></use>
                                </svg>
                            </span>
                                <span class="sidebar-menu__title">Модуль КПК</span>
                            </a>
                        </li>
                    @endif
                    @if(request()->user()->can(\App\Enums\PermissionEnum::CREATE_BOOKMARKS->value))
                        <li class="sidebar-menu__item"><a
                                class="sidebar-menu__link @if(request()->routeIs('user.bookmarks.*')) is-active @endif"
                                href="{{route('user.bookmarks.index')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="16" height="20">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                </svg></span><span class="sidebar-menu__title">Кабінет</span></a></li>
                    @endif
                    @if(request()->user()->can(\App\Enums\PermissionEnum::CREATE_OWN_PAGES->value))
                        <li class="sidebar-menu__item">
                            <a class="sidebar-menu__link @if(request()->routeIs('user.files.*')) is-active @endif"
                               href="{{ route('user.files.index') }}">
                                <span class="sidebar-menu__pic"><svg class="sidebar-menu__icon" width="17" height="21"><use
                                            xlink:href="{{asset('assets/img/user/sprite.svg#file')}}"></use></svg></span>
                                <span class="sidebar-menu__title">Робота з файлами</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-menu__item">
                        <a class="sidebar-menu__link @if(request()->routeIs('user.registries.*')) is-active @endif"
                           href="{{ route('user.registries.index') }}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="21" height="17">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#folder')}}"></use>
                </svg></span><span class="sidebar-menu__title">Реєстри</span></a></li>
                    <li class="sidebar-menu__item"><a
                            class="sidebar-menu__link @if(request()->routeIs('user.subscription.index')) is-active @endif"
                            href="{{ route('user.subscription.index') }}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="20" height="19">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#subscribe')}}"></use>
                </svg></span><span class="sidebar-menu__title">Моя підписка</span></a></li>

                    <li class="sidebar-menu__item">
                        <a class="button button--app mobile-nav-menu__button" href="#">
                            <svg class="button__icon" width="78" height="22">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#app-store') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a class="button button--app mobile-nav-menu__button" href="#">
                            <svg class="button__icon" width="85" height="21">
                                <use xlink:href="{{ asset('assets/img/sprite.svg#google-play') }}"></use>
                            </svg>
                        </a>
                    </li>
                </ul>


            </nav>
        </div>
    </div>
</aside>
