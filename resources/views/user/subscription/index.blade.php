@extends('layouts.user_app')
@section('title', $systemPage->title ?? 'Моя підписка')

@section('page')
    <section class="subscription-section">
        <div class="container subscription-section__container">
            <h1 class="page-title subscription-section__title">{{ $systemPage->title ?? 'Моя підписка' }}</h1>
            <div class="current-subscription">
                @if($user->activeSubscription)
                    @if($user->allSubscriptions()->count() == 1 && $user->activeSubscription->period === 'trial')
                        <div class="current-subscription__info">
                            <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_FREE_TRIAL) }}</h3>
                            <div class="current-subscription__date">{{ \App\Helpers\SubscriptionHelper::getVariableSubTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_FREE_TRIAL) }}</div>
                        </div>
                    @elseif(!$user->activeSubscription->price && !$user->activeSubscription->session)
                        <div class="current-subscription__info">
                            <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_FREE) }}</h3>
                            <div class="current-subscription__date">{{ \App\Helpers\SubscriptionHelper::getVariableSubTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_FREE) }}</div>
                        </div>
                    @else
                        <div class="current-subscription__info">
                            @if($user->activeSubscription->isCancelled())
                                <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_CANCELLED) }}</h3>
                                <div class="current-subscription__date">{{ \App\Helpers\SubscriptionHelper::getVariableSubTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_CANCELLED) }}</div>
                                @if($user->pendingSubscription && $user->activeSubscription->id != $user->pendingSubscription->id)
                                    <hr>

                                    <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_PENDING) }}</h3>
                                    <div class="current-subscription__date">{{ \App\Helpers\SubscriptionHelper::getVariableSubTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_PENDING) }}</div>
                                @endif
                            @else
                                <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_ACTIVE) }}</h3>
                                <div class="current-subscription__date">{{ \App\Helpers\SubscriptionHelper::getVariableSubTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_ACTIVE) }}</div>
                            @endif
                        </div>
                        @if(!$user->activeSubscription->isCancelled() && $user->activeSubscription->session)
                            <form action="{{ route('user.subscription.cancel') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button button--red subscription-section__button" type="submit"
                                        onclick="return confirm('Ви впевнені, що хочете скасувати відписку?')">Відмінити
                                    підписку
                                </button>
                            </form>
                        @endif
                    @endif
                @else
                    <div class="current-subscription__info">
                        <h3 class="current-subscription__title">{{ \App\Helpers\SubscriptionHelper::getVariableTitle(\App\Enums\SettingEnum::SUBSCRIPTION_TEXT_MISSING) }}</h3>
                    </div>
                @endif


                {{--                <button class="button button--outline current-subscription__button" type="button">Продовжити підписку</button>--}}
            </div>

            <div class="tariffs">
                <input type="hidden" id="selectedPeriod" value="month">
                <h3 class="tariffs__title">{{ $systemPage->getDataByDotPath('0.body') }}</h3>
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
                                            @if(!$user->hadSubscription())
                                                <p style="margin-top: 20px;color: #1d3f68;">5 днів безкоштовне демо</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tariff-card__footer">
                                        <div class="tariff-card__total">
                                            <div class="tariff-card__price">Вартість
                                                <span>{{ $plan->price_monthly }}₴</span></div>
                                            <div class="tariff-card__discount" data-months="1"
                                                 data-price="{{ $plan->price_monthly }}₴"
                                                 style="display: none">{{ ($plan->price_annual / 12) }}₴ / 1 міс
                                            </div>
                                            <div class="tariff-card__discount" data-months="12"
                                                 data-price="{{ $plan->price_annual }}₴">{{ ($plan->price_monthly * 12) }}₴ / 12
                                                міс{{-- (-{{ $plan->getAnnualDiscountSum() }}₴)--}}
                                            </div>
                                        </div>

                                        @if(!$user->activeSubscription || $user->activeSubscription->period === 'trial')
                                        @php($monthPaymentData = $plan->getCheckoutData($user, 'month'))
                                        <form id="monthPaymentForm" method="POST" action="{{ $monthPaymentData->action }}" accept-charset="utf-8">
                                            <input type="hidden" name="data" value="{{ $monthPaymentData->data }}"/>
                                            <input type="hidden" name="signature" value="{{ $monthPaymentData->signature }}"/>
                                            <input type="image"
                                                   src="//static.liqpay.ua/buttons/payUk.png" style="height: 70px;"/>
                                        </form>
                                        @php($yearPaymentData = $plan->getCheckoutData($user, 'year'))
                                        <form id="yearPaymentForm" method="POST" action="{{ $yearPaymentData->action }}" accept-charset="utf-8" style="display: none">
                                            <input type="hidden" name="data" value="{{ $yearPaymentData->data }}"/>
                                            <input type="hidden" name="signature" value="{{ $yearPaymentData->signature }}"/>
                                            <input type="image"
                                                   src="//static.liqpay.ua/buttons/payUk.png" style="height: 70px;"/>
                                        </form>
                                        @endif

{{--                                        @if(!$user->activeSubscription--}}
{{--                                                || ($user->activeSubscription && $user->activeSubscription->isCancelled() && !$user->pendingSubscription))--}}
{{--                                            <button class="button tariff-card__buy-button show_payment_modal"--}}
{{--                                                    type="button"--}}
{{--                                                    data-id="{{ $plan->id }}" data-title="{{ $plan->title }}"--}}
{{--                                                    data-url="{{ route('user.subscription.payment-data', $plan) }}"--}}
{{--                                                    data-modal="modal-payment">Обрати--}}
{{--                                            </button>--}}
{{--                                        @endif--}}
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
