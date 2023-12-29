@extends('layouts.user_app')
@section('title', 'Профіль')
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
                        <button class="button button--outline tariffs-list__button is-active" type="button">На місяць</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button">На пів року</button>
                    </li>
                    <li class="tariffs-list__item">
                        <button class="button button--outline tariffs-list__button" type="button">На рік</button>
                    </li>
                </ul>
                <div class="tariff-card tariffs__card">
                    <div class="tariff-card__body">
                        <h3 class="tariff-card__title">Тариф LITE</h3>
                        <ul class="tariff-card__list">
                            <li class="tariff-card__item"><strong>Інтелектуальний пошук</strong>
                                <div class="tariff-card__status tariff-card__status--green">
                                    <svg class="tariff-card__status-icon" width="15" height="11">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#check')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><strong>Доступна база правових позицій</strong>
                                <div class="tariff-card__status tariff-card__status--green">
                                    <svg class="tariff-card__status-icon" width="15" height="11">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#check')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><span>Можливість скачувати сторінку кнопкою export</span>
                                <div class="tariff-card__status">
                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><span>Можливість створювати закладки по рішенням в особистому кабінеті</span>
                                <div class="tariff-card__status">
                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><span>Можливість відмічати жовтим кольором потрібне</span>
                                <div class="tariff-card__status">
                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><span>Можливість самостійно створювати свої особисті сторінки з рішеннями, просвоювати імена рішенням з прив’язкою до посилання і т.п.</span>
                                <div class="tariff-card__status">
                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                    </svg>
                                </div>
                            </li>
                            <li class="tariff-card__item"><span>Можливість копіювати сторінку</span>
                                <div class="tariff-card__status">
                                    <svg class="tariff-card__status-icon" width="15" height="15">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#cross')}}"></use>
                                    </svg>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tariff-card__footer">
                        <div class="tariff-card__total">
                            <div class="tariff-card__price">Вартість 5$</div>
                            <div class="tariff-card__discount">27$ / 6 мес (-10%)</div>
                            <div class="tariff-card__discount">48$ / 12 мес (-20%)</div>
                        </div>
                        <button class="play-button tariff-card__play-button" type="button" data-modal="modal-video"><span class="play-button__pic">
              <svg class="play-button__icon" width="11" height="14">
                <use xlink:href="{{asset('assets/img/user/sprite.svg#play')}}"></use>
              </svg></span>Як це працює?</button>
                        <button class="button tariff-card__buy-button" type="button" data-modal="modal-period">Обрати</button>
                    </div>
                </div>
                <div class="tariff-max tariffs__max">
                    <div class="tariff-max__col tariff-max__col--5">
                        <h3 class="tariff-max__title">Незабаром вийде тариф MAX</h3>
                        <p class="tariff-max__descr">Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних юридичних ресурсів?</p>
                    </div>
                    <div class="tariff-max__col tariff-max__col--4">
                        <div class="tariff-max__info">Ми вже працюємо над базой кримінального законодавства</div>
                        <div class="tariff-max__total">
                            <div class="tariff-max__price">Вартість 8$</div>
                            <div class="tariff-max__discount">43$ / 6 мес (-10%)</div>
                            <div class="tariff-max__discount">76$ / 12 мес (-22%)</div>
                        </div>
                    </div>
                    <div class="tariff-max__col tariff-max__col--3">
                        <picture class="tariff-max__picture"><img class="tariff-max__img" src="{{asset('assets/img/user/tariff-img.webp')}}" srcset="{{asset('assets/img/user/tariff-img@2x.webp 2x')}}" loading="lazy" width="231" height="140" alt="alt"/></picture>
                    </div>
                </div>
            </div>
            <div class="subscription-section__buttons">
                <button class="button button--red subscription-section__button" type="button" data-modal="modal-delete">Відмінити підписку</button>
            </div>
        </div>
    </section>
@endsection
