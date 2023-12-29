<aside class="sidebar">
    <div class="sidebar__panel">
        <div class="sidebar__inner">
            <div class="logo sidebar__logo"><a class="logo__link" href="#" aria-label="logo">
                    <svg class="logo__img" width="38" height="32">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#logo')}}"></use>
                    </svg><span class="logo__title">Збірник</span></a></div>
            <nav class="sidebar-menu">
                <ul class="sidebar-menu__list">
                    <li class="sidebar-menu__item">
                        <a class="sidebar-menu__link @if(request()->routeIs('profile')) is-active @endif" href="{{route('profile')}}">
                            <span class="sidebar-menu__pic">
                                <svg class="sidebar-menu__icon" width="17" height="19">
                                  <use xlink:href="{{asset('assets/img/user/sprite.svg#user')}}"></use>
                                </svg>
                            </span>
                            <span class="sidebar-menu__title">Мій профіль</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item"><a class="sidebar-menu__link @if(request()->routeIs('collection')) is-active @endif" href="{{route('collection')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="22" height="18">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#book')}}"></use>
                </svg></span><span class="sidebar-menu__title">Збірник</span></a></li>
                    <li class="sidebar-menu__item"><a class="sidebar-menu__link @if(request()->routeIs('favourites')) is-active @endif" href="{{route('favourites')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="16" height="20">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                </svg></span><span class="sidebar-menu__title">Закладки</span></a></li>
                    <li class="sidebar-menu__item"><a class="sidebar-menu__link @if(request()->routeIs('edit_page')) is-active @endif" href="{{route('edit_page')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="17" height="21">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#file')}}"></use>
                </svg></span><span class="sidebar-menu__title">Робота з файлами</span></a></li>
                    <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="#"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="21" height="17">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#folder')}}"></use>
                </svg></span><span class="sidebar-menu__title">Реєстри</span></a></li>
                    <li class="sidebar-menu__item"><a class="sidebar-menu__link @if(request()->routeIs('subscription')) is-active @endif" href="{{route('subscription')}}"><span class="sidebar-menu__pic">
                <svg class="sidebar-menu__icon" width="20" height="19">
                  <use xlink:href="{{asset('assets/img/user/sprite.svg#subscribe')}}"></use>
                </svg></span><span class="sidebar-menu__title">Моя підписка</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
