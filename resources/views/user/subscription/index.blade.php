@extends('layouts.user_app')

@section('title', 'Моя підписка')

@section('page')
    <section class="subscription-section">
        <div class="container subscription-section__container">
            <h1 class="page-title subscription-section__title">Моя підписка</h1>
            <div class="current-subscription">
                @if($user->activeSubscription)
                    <div class="current-subscription__info">
                        <h3 class="current-subscription__title">Зараз ви використовуєте <strong class="blue-color"><a
                                    class="blue-link" href="#">тариф
                                    {{ $user->activeSubscription->plan->title }}</a>
                                - {{ $user->activeSubscription->plan->getPriceWithPeriodByPeriod($user->activeSubscription->period) }}
                            </strong></h3>
                        @if($user->activeSubscription->isCancelled())
                            <div class="current-subscription__date">Підписка скасована. Оплачений період завершується {{ $user->activeSubscription->expires_at->format('d.m.Y') }}</div>
                            @else
                        <div class="current-subscription__date">Наступний
                            платіж {{ $user->activeSubscription->expires_at->format('d.m.Y') }}</div>
                        @endif
                    </div>
                    @if(!$user->activeSubscription->isCancelled())
                    <form action="{{ route('user.subscription.cancel') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button button--red subscription-section__button" type="submit" onclick="return confirm('Ви впевнені, що хочете скасувати відписку?')">Відмінити підписку
                        </button>
                    </form>
                    @endif
                @else
                    <div class="current-subscription__info">
                        <h3 class="current-subscription__title">Наразі у вас немає активної підписки!</h3>
                    </div>
                @endif


                {{--                <button class="button button--outline current-subscription__button" type="button">Продовжити підписку</button>--}}
            </div>

            <input type="hidden" id="selectedPeriod" value="month">

            <div class="tariffs">
                <h3 class="tariffs__title">Ви можете обрати кращий тариф який надасть вам можливість використання нашого
                    сервісу по максимуму. </h3>
                <ul class="tariffs-list">
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button is-active" type="button"
                                data-months="1" onclick="$('#selectedPeriod').val('month')">На місяць
                        </button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button" data-months="12"
                                onclick="$('#selectedPeriod').val('year')">На рік
                        </button>
                    </li>
                </ul>

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
                                                            <svg class="tariff-card__status-icon" width="15"
                                                                 height="11">
                                                                <use
                                                                    xlink:href="{{asset('assets/img/user/sprite.svg#check')}}"></use>
                                                            </svg>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li class="tariff-card__item"><span>{{ $feature->title }}</span>
                                                        <div class="tariff-card__status">
                                                            <svg class="tariff-card__status-icon" width="15"
                                                                 height="15">
                                                                <use
                                                                    xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                                            </svg>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="tariff-card__buttons">
                                            <button class="button button--outline tariff-card__button" type="button">1
                                                день безкоштовне демо
                                            </button>
                                            <button class="play-button" type="button" data-modal="modal-video"><span
                                                    class="play-button__pic">
                      <svg class="play-button__icon" width="11" height="14">
                        <use xlink:href="img/sprite.svg#play"></use>
                      </svg></span>Як це працює?
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tariff-card__footer">
                                        <div class="tariff-card__total">
                                            <div class="tariff-card__price">Вартість
                                                <span>{{ $plan->price_monthly }}$</span></div>
                                            <div class="tariff-card__discount" data-months="1"
                                                 data-price="{{ $plan->price_monthly }}$"
                                                 style="display: none">{{ $plan->price_monthly }}$ / 1 міс
                                            </div>
                                            <div class="tariff-card__discount" data-months="12"
                                                 data-price="{{ $plan->price_annual }}$">{{ $plan->price_annual }}$ / 12
                                                міс (-{{ $plan->getAnnualDiscountPercent() }}%)
                                            </div>
                                        </div>
                                        @if(!$user->activeSubscription)
                                            <button class="button tariff-card__buy-button show_payment_modal"
                                                    type="button"
                                                    data-id="{{ $plan->id }}" data-title="{{ $plan->title }}"
                                                    data-url="{{ route('user.subscription.payment-data', $plan) }}"
                                                    data-modal="modal-payment">Обрати
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination tariffs-slider__pagination"></div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('modals')
    @include('layouts.modals.video')
    @include('layouts.modals.payment')
    @include('layouts.modals.payment-processing')
@endpush

@push('scripts')
    <script src="{{ asset('user/js/subscription.js') }}"></script>
@endpush
