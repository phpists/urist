@extends('layouts.app')
@section('title', $systemPage->title)
@section('page')
    <section class="top-section">
        <div class="container top-section__container">
            <div class="top-section__row">
                <div class="top-section__left">
                    <h1 class="top-section__title">{!! $systemPage->getHtmlString('0.title') !!}</h1>
                    <p class="top-section__slogan">{{ $systemPage->getDataByDotPath('0.body') }}</p>
                    <a class="button top-section__button" href="{{ $systemPage->getDataByDotPath('0.button_link') }}">{{ $systemPage->getDataByDotPath('0.button_text') }}</a>
                </div>
                <div class="top-section__right">
                    <picture class="top-section__picture">
                        <img class="top-section__img" src="{{ $systemPage->getImageSrc(0) }}" loading="lazy" width="643" height="380" alt="alt"/>
                    </picture>
                </div>
            </div>
            <h2 class="section-title top-section__sub-title">{{ $systemPage->getDataByDotPath('1.title') }}</h2>
            <ul class="top-section__list">
                @if(isset($systemPage->data[1]['items']) && is_array($systemPage->data[1]['items']))
                    @foreach($systemPage->data[1]['items'] as $item)
                        <li class="top-section__item @if($loop->first) top-section__item--12 @endif ">
                            <div class="goal-card">
                                <div class="goal-card__header">
                                    <div class="goal-card__icon">{{ $item['icon'] ?? '' }}</div>
                                    <h3 class="goal-card__title">{{ $item['title'] ?? '' }}</h3>
                                </div>
                                <div class="goal-card__body">
                                    {!! $item['body'] ?? '' !!}
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>

    <section class="why-section">
        <div class="container why-section__container">
            <h2 class="section-title why-section__title">{{ $systemPage->getDataByDotPath('2.title') }}</h2>
            <ul class="why-section__list">
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">1</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.0') }}</p>
                </li>
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">2</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.1') }}</p>
                </li>
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">3</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.2') }}</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">4</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.3') }}</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">5</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.4') }}</p>
                </li>
                <li class="why-section__item why-section__item--8">
                    <div class="why-section__number">6</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.5') }}</p>
                </li>
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">7</div>
                    <p class="why-section__text">{{ $systemPage->getDataByDotPath('2.items.6') }}</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="decision-section"> {{-- Є рішення --}}
        <div class="container decision-section__container">
            <h2 class="section-title decision-section__title">{{ $systemPage->getDataByDotPath('3.title') }}</h2>
            <ul class="decision-section__list">
                @if(isset($systemPage->data[3]['items']) && is_array($systemPage->data[3]['items']))
                    @foreach($systemPage->data[3]['items'] as $i => $item)
                        @continue(empty($item['title']))
                        <li class="decision-section__item">
                            <div class="decision-section__col">
                                @if(isset($item['img']))
                                    <picture class="decision-section__picture">
                                        <img class="decision-section__img"
                                             src="{{ $systemPage->getDataImgSrcByDot("3.items.{$i}.img") }}"
                                             loading="lazy" width="626" height="380" alt="alt"/>
                                    </picture>
                                @endif
                                <div class="decision-section__number">{{ $i + 1 }}</div>

                                @if(isset($item['quote']))
                                    <div class="decision-section__quote">
                                        <p>{{ $item['quote'] }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="decision-section__col">
                                <h3 class="decision-section__sub-title">{{ $item['title'] ?? '' }}</h3>
                                <div class="decision-section__text">
                                    {!! $item['body'] ?? '' !!}
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>

    <section class="tariffs-section" id="tariffs-section">
        <div class="container tariffs-section__container">
            <h2 class="section-title tariffs-section__title">Тарифи</h2>
            <nav class="tariffs-plan">
                <ul class="tariffs-plan__list">
                    <li class="tariffs-plan__item">
                        <button class="tariffs-plan__button is-active" type="button" data-months="1">В місяць</button>
                    </li>
                    <li class="tariffs-plan__item">
                        <button class="tariffs-plan__button" type="button" data-months="12">На рік</button>
                    </li>
                </ul>
            </nav>
            <div class="swiper tariffs-slider">
                <div class="swiper-wrapper">
                    @foreach($plans as $plan)
                    <div class="swiper-slide tariffs-slider__slide">
                        <div class="tariff-card">
                            <div class="tariff-card__body">
                                <h3 class="tariff-card__title">Тариф {{ $plan->title }}</h3>
                                <ul class="tariff-card__list">
                                    @foreach($features as $feature)
                                        @if($plan->activeFeatures->contains($feature))
                                        <li class="tariff-card__item"><strong>{{ $feature->title }}</strong>
                                            <div class="tariff-card__status tariff-card__status--green">
                                                <svg class="tariff-card__status-icon" width="15" height="11">
                                                    <use xlink:href="{{ asset('img/sprite.svg#check') }}"></use>
                                                </svg>
                                            </div>
                                        </li>
                                        @else
                                            <li class="tariff-card__item"><span>{{ $feature->title }}</span>
                                                <div class="tariff-card__status">
                                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                                        <use xlink:href="{{ asset('img/sprite.svg#cross') }}"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="tariff-card__buttons">
                                    @if(!auth()->user()?->hadSubscription())
                                    <button class="button button--outline tariff-card__button" type="button">1 день безкоштовне демо</button>
                                    @endif
                                    <button class="play-button" type="button" data-modal="modal-video"><span class="play-button__pic">
                    <svg class="play-button__icon" width="11" height="14">
                      <use xlink:href="{{ asset('img/sprite.svg#play') }}"></use>
                    </svg></span>Як це працює?</button>
                                </div>
                            </div>
                            <div class="tariff-card__footer">
                                <div class="tariff-card__total">
                                    <div class="tariff-card__price">Вартість <span>{{ $plan->price_monthly }}$</span></div>
                                    <div class="tariff-card__discount" data-months="1" data-price="{{ $plan->price_monthly }}$" style="display: none">{{ $plan->price_monthly }}$ / 1 мес</div>
                                    <div class="tariff-card__discount" data-months="12" data-price="{{ $plan->price_annual }}$">{{ $plan->price_annual }}$ / 12 мес (-{{ $plan->getAnnualDiscountPercent() }}%)</div>
                                </div>
                                <a class="button tariff-card__buy-button" href="{{ auth()->check() ? route('user.subscription.index') : route('login') }}">Обрати</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination tariffs-slider__pagination"></div>
            </div>
        </div>
    </section>

    <section class="try-section">
        <div class="container try-section__container">
            <div class="try-section__left">
                <h2 class="section-title try-section__title">{!! $systemPage->getHtmlString('4.title') !!}</h2>
                <p class="try-section__descr">{{ $systemPage->getDataByDotPath('4.body') }}</p><a
                    class="button button--white try-section__button" href="{{ $systemPage->getDataByDotPath('4.button_link') }}">{{ $systemPage->getDataByDotPath('4.button_text') }}</a>
            </div>
            <div class="try-section__right">
                <picture class="try-section__picture">
                    <img class="try-section__img" src="{{ $systemPage->getImageSrc(1) }}" loading="lazy"
                         width="452" height="312" alt="alt"/>
                </picture>
            </div>
        </div>
    </section>

    <section class="seo-section">
        <div class="container seo-section__container">
            <h2 class="section-title seo-section__title">{{ $systemPage->getDataByDotPath('5.title') }}</h2>
            <div class="seo-section__text">
                {!! $systemPage->getDataByDotPath('5.body') !!}
            </div>
            <button class="seo-section__more" type="button">Читати детальніше
                <svg class="arrow-button__icon" width="8" height="4">
                    <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                </svg>
            </button>
        </div>
    </section>


    @include('layouts.partials.modals')
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush
