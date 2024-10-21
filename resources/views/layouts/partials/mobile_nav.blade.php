        <!-- Mobile Nav -->

<div class="mobile-nav">
  <div class="mobile-nav__sidebar">
    <div class="mobile-nav__inner">
      <nav class="mobile-nav-menu">
        <ul class="mobile-nav-menu__list">
          <li class="mobile-nav-menu__item"><a class="mobile-nav-menu__link" href="{{route('home')}}#tariffs-section">Тарифи</a></li>
          <li class="mobile-nav-menu__item"><a class="mobile-nav-menu__link" href="{{route('blog.index')}}">Блог</a></li>
          <li class="mobile-nav-menu__item"><a class="mobile-nav-menu__link" href="{{route('faq')}}">FAQ</a></li>
          <li class="mobile-nav-menu__item"><a class="mobile-nav-menu__link" href="{{route('contacts')}}">Контакти</a></li>
          <li class="mobile-nav-menu__item"><a class="mobile-nav-menu__link" href="{{route('about')}}">Про нас</a></li>

            <li class="mobile-nav-menu__item">
                <a class="button button--app mobile-nav-menu__button" href="{{ \App\Services\SettingService::getValueByName(\App\Enums\SettingEnum::APPLE_STORE_URL->value) }}">
                    <svg class="button__icon" width="78" height="22">
                        <use xlink:href="{{ asset('assets/img/sprite.svg#app-store') }}"></use>
                    </svg>
                </a>
                <a class="button button--app mobile-nav-menu__button" href="{{ \App\Services\SettingService::getValueByName(\App\Enums\SettingEnum::GOOGLE_STORE_URL->value) }}">
                    <svg class="button__icon" width="85" height="21">
                        <use xlink:href="{{ asset('assets/img/sprite.svg#google-play') }}"></use>
                    </svg>
                </a>
            </li>
            <li class="mobile-nav-menu__item">
                <div class="qr-code">
                    <img class="qr-code__img" src="{{ asset('assets/img/qr-code.webp') }}"
                         srcset="{{ asset('assets/img/qr-code@2x.webp') }} 2x"
                         loading="lazy" width="84" height="82" alt="alt"/>
                </div>
            </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
