@extends('layouts.user_app')

@section('title', 'Моя підписка')

@section('page')
    <section class="subscription-section">
        <div class="container subscription-section__container">
            <h1 class="page-title subscription-section__title">Моя підписка</h1>
            <div class="current-subscription">
                <div class="current-subscription__info">
                    <h3 class="current-subscription__title">Зараз ви використовуєте <strong class="blue-color"><a class="blue-link" href="#">тариф Lite</a> - 5$/місяць</strong></h3>
                    <div class="current-subscription__date">Активний до 27.12.2023</div>
                    <div class="current-subscription__id">ID 9384734986</div>
                </div>
                <button class="button button--outline current-subscription__button" type="button">Продовжити підписку</button>
            </div>
            <div class="tariffs">
                <h3 class="tariffs__title">Ви можете обрати кращий тариф який надасть вам можливість використання нашого сервісу по максимуму. </h3>
                <ul class="tariffs-list">
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button is-active" type="button"data-months="1">На місяць</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button" data-months="6">На пів року</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button" data-months="12">На рік</button>
                    </li>
                </ul>

                @foreach($plans as $plan)
                <div class="tariff-card tariffs__card">
                    <div class="tariff-card__body">
                        <h3 class="tariff-card__title">Тариф {{ $plan->title }}</h3>
                        <ul class="tariff-card__list">
                            @foreach($features as $feature)
                                @if($plan->activeFeatures->contains($feature))
                                    <li class="tariff-card__item"><strong>{{ $feature->title }}</strong>
                                        <div class="tariff-card__status tariff-card__status--green">
                                            <svg class="tariff-card__status-icon" width="15" height="11">
                                                <use xlink:href="{{asset('assets/img/user/sprite.svg#check')}}"></use>
                                            </svg>
                                        </div>
                                    </li>
                                @else
                                    <li class="tariff-card__item"><span>{{ $feature->title }}</span>
                                        <div class="tariff-card__status">
                                            <svg class="tariff-card__status-icon" width="15" height="15">
                                                <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                            </svg>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="tariff-card__footer">
                        <div class="tariff-card__total">
                            <div class="tariff-card__price">Вартість <span>{{ $plan->price_monthly }}$</span></div>
                            <div class="tariff-card__discount" data-months="1" data-price="{{ $plan->price_monthly }}$" style="display: none">{{ $plan->price_monthly }}$ / 1 мес</div>
                            <div class="tariff-card__discount" data-months="6" data-price="{{ $plan->price_semiannual }}$">{{ $plan->price_semiannual }}$ / 6 мес (-{{ $plan->getSemiannualDiscountPercent() }}%)</div>
                            <div class="tariff-card__discount" data-months="12" data-price="{{ $plan->price_annual }}$">{{ $plan->price_annual }}$ / 12 мес (-{{ $plan->getAnnualDiscountPercent() }}%)</div>
                        </div>
                        <button class="play-button tariff-card__play-button" type="button" data-modal="modal-video"><span class="play-button__pic">
              <svg class="play-button__icon" width="11" height="14">
                <use xlink:href="{{asset('assets/img/user/sprite.svg#play')}}"></use>
              </svg></span>Як це працює?</button>
                        <button class="button tariff-card__buy-button" type="button" data-modal="modal-period">Обрати</button>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="subscription-section__buttons">
                <button class="button button--red subscription-section__button" type="button" data-modal="modal-delete">Відмінити підписку</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('user_build/js/subscription.js') }}"></script>
@endpush
