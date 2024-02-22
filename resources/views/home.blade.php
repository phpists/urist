@extends('layouts.app')
@section('title', 'Домашня')
@section('page')
    <section class="top-section">
        <div class="container top-section__container">
            <div class="top-section__row">
                <div class="top-section__left">
                    <h1 class="top-section__title">База правових
                        позицій<span>LEX GO</span></h1>
                    <p class="top-section__slogan">Онлайн сервіс, який допоможе вам зрозуміти та оцінити важливість
                        судових рішень</p><a class="button top-section__button" href="#tariffs-section">Спробувати</a>
                </div>
                <div class="top-section__right">
                    <picture class="top-section__picture"><img class="top-section__img" src="/assets/img/top-img.webp"
                                                               srcset="/assets/img/top-img@2x.webp 2x" loading="lazy"
                                                               width="643" height="380" alt="alt"/></picture>
                </div>
            </div>
            <h2 class="section-title top-section__sub-title">Наша мета</h2>
            <ul class="top-section__list">
                <li class="top-section__item top-section__item--12">
                    <div class="goal-card">
                        <div class="goal-card__header">
                            <div class="goal-card__icon">💼</div>
                            <h3 class="goal-card__title">Порядок</h3>
                        </div>
                        <div class="goal-card__body">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали серед тисяч (далі змінити на
                                текст наступного змісту: "юридичних ресурсів (фейсбук, телеграм, ЄДРСР, тощо)?</p>
                            <p>Коли ви (далі змінити на текст наступного змісту: "зберегли цікавий висновок ККС, і не
                                можете знайти його серед тисяч скріншотів, постів/ репостів на стіні у ФБ тощо?"</p>
                            <p>Ми розробили..... до Ваших послуг. Доповнити: "Відтепер все в одному місці та завжи
                                поруч"</p>
                        </div>
                    </div>
                </li>
                <li class="top-section__item">
                    <div class="goal-card">
                        <div class="goal-card__header">
                            <div class="goal-card__icon">⏱️</div>
                            <h3 class="goal-card__title">Швидкість = час!</h3>
                        </div>
                        <div class="goal-card__body">
                            <p>Даний ресурс робить процес пошуку відповіді на юридичне питання простим, зручним,
                                швидким.</p>
                            <p>Структура бази, викладки сторінки із судовим рішенням, надані інструменти допоможуть
                                досягнути цієї мети та зекономити час.</p>
                        </div>
                    </div>
                </li>
                <li class="top-section__item">
                    <div class="goal-card">
                        <div class="goal-card__header">
                            <div class="goal-card__icon">😉</div>
                            <h3 class="goal-card__title">Зручність</h3>
                        </div>
                        <div class="goal-card__body">
                            <p>Даний продукт виконано у двох формах: веб сайту та мобільних додатків на базі android та iOS, що дозволяє зручно користуватися ним у будь-який час.</p>
                        </div>
                    </div>
                </li>
                <li class="top-section__item">
                    <div class="goal-card">
                        <div class="goal-card__header">
                            <div class="goal-card__icon">🏠</div>
                            <h3 class="goal-card__title">Надійність</h3>
                        </div>
                        <div class="goal-card__body">
                            <p>Зручне, надійне місце зберігання персональної бібліотеки. Відтепер, Ви позбудетесь
                                побоювань втратити все з ризиком неможливості відновлення втрачених багаторічних
                                напрацювань.</p>
                            <p>Все надійно зберігається в одному місці і завжди під рукою.</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section class="why-section">
        <div class="container why-section__container">
            <h2 class="section-title why-section__title">Чому саме цей ресурс?</h2>
            <ul class="why-section__list">
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">1</div>
                    <p class="why-section__text">Структура бази, подібна до структури кк, кпк</p>
                </li>
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">2</div>
                    <p class="why-section__text">Викладка судових рішень за постатейною логікою зберігання та темами у
                        кінцевому каталогу</p>
                </li>
                <li class="why-section__item why-section__item--4">
                    <div class="why-section__number">3</div>
                    <p class="why-section__text">Iнтелектуальна система пошуку</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">4</div>
                    <p class="why-section__text">Особистий кабінет із корисними функціями та персональним налаштуванням
                        під корисувача для створення власної бібліотеки</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">5</div>
                    <p class="why-section__text">Проста та зрозуміла структура сторінки із судовим рішенням: назва,
                        реквізити рішення, правовий висновок, судове рішення. Вже по назві рішення з 3-7 слів зрозумілий
                        правовий висновок загалом</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">6</div>
                    <p class="why-section__text">Додатково опрацьовано візуалізацію на кожному етапі роботи з базою.  Якщо вина на етапі дослідження змісту каталогів, обираєте необхідний розділ/главу/статтю з використанням чекбоксу – навігаційна панель переважає у розмірі над вікном візуалізації збірок правових позицій. А коли Ви працюєте над дослідженням викладених правових позицій, можна розвернути вікно викладки для кращого візуального сприйняття</p>
                </li>
                <li class="why-section__item why-section__item--6">
                    <div class="why-section__number">7</div>
                    <p class="why-section__text">Можливість використання мобільного додатку або веб версії</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="decision-section">
        <div class="container decision-section__container">
            <h2 class="section-title decision-section__title">Є рішення</h2>
            <ul class="decision-section__list">
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">1</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">2</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">3</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">4</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">5</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">6</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">7</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
                <li class="decision-section__item">
                    <div class="decision-section__col">
                        <picture class="decision-section__picture"><img class="decision-section__img"
                                                                        src="/assets/img/decision-img.webp"
                                                                        srcset="/assets/img/decision-img@2x.webp 2x"
                                                                        loading="lazy" width="626" height="380"
                                                                        alt="alt"/></picture>
                        <div class="decision-section__number">8</div>
                        <div class="decision-section__quote">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                    <div class="decision-section__col">
                        <h3 class="decision-section__sub-title">Нарешті всі ваші рахунки в одному місці, завдяки прямим
                            інтеграціям</h3>
                        <div class="decision-section__text">
                            <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних
                                юридичних ресурсів?</p>
                        </div>
                    </div>
                </li>
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
                        <button class="tariffs-plan__button" type="button" data-months="6">На пів року</button>
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
                                    <button class="button button--outline tariff-card__button" type="button">1 день безкоштовне демо</button>
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
                                    <div class="tariff-card__discount" data-months="6" data-price="{{ $plan->price_semiannual }}$">{{ $plan->price_semiannual }}$ / 6 мес (-{{ $plan->getSemiannualDiscountPercent() }}%)</div>
                                    <div class="tariff-card__discount" data-months="12" data-price="{{ $plan->price_annual }}$">{{ $plan->price_annual }}$ / 12 мес (-{{ $plan->getAnnualDiscountPercent() }}%)</div>
                                </div>
                                <a class="button tariff-card__buy-button" href="{{ auth()->check() ? route('user.subscription.index') : route('register.page') }}">Обрати</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination tariffs-slider__pagination"></div>
            </div>
        </div>
    </section>

    <section class="feedback-section">
        <div class="container feedback-section__container">
            <h2 class="section-title feedback-section__title">Опитування</h2>
            <div class="feedback-section__text">
                <p>Побажання нам для покращення проекту.</p>
                <p>Ви можете заповнити форму нижче і ми врахуємо ці побажання у майбутньому.</p>
            </div>
            <form class="form feedback-section__form" id="feedback-form" action="{{ route('home.form') }}" method="POST" autocomplete="off" novalidate="novalidate">
                @csrf
                <div class="form__row">
                    <div class="form__col">
                        <input class="input form__input" id="inputName" type="text" name="name"
                               placeholder="Ім’я *" autocomplete="off" required="required"/>
                    </div>
                    <div class="form__col">
                        <input class="input form__input" id="inputEmail" type="email" name="email"
                               placeholder="Email *" autocomplete="off" required="required"/>
                    </div>
                </div>
                <div class="form__group">
                    <textarea class="textarea form__input" id="textareaFeedback" name="message" rows="8"
                              placeholder="Побажання *" autocomplete="off" required="required"></textarea>
                </div>
                <div class="form__group form__group--center">
                    <div class="checkbox">
                        <input class="checkbox__input" id="checkboxAgree" type="checkbox" name="checkbox" value="true"
                               required="required"/>
                        <label class="checkbox__label" for="checkboxAgree">
                            Погоджуюсь з
                            <a class="blue-link" href="#">Політикою конфіденційності</a>
                            та
                            <a class="blue-link" href="#">Офертою</a>
                        </label>
                    </div>
                </div>
                <div class="form__button-group">
                    <button type="submit" class="button form__button">Надіслати</button>
                    <button type="button" data-modal="modal-success" style="display:none;"></button>
                </div>
            </form>
        </div>
    </section>

    <section class="reviews-section">
        <div class="container reviews-section__container">
            <h2 class="section-title reviews-section__title">Відгуки</h2>
            <div class="swiper reviews-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="5">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="4">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="5">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="4">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="5">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <div class="swiper-slide reviews-slider__slide">
                        <div class="review-card">
                            <div class="review-card__header">
                                <h3 class="review-card__name">Іван Іванов</h3>
                                <time class="review-card__date">21.11.2023</time>
                            </div>
                            <div class="rating review-card__rating" data-rating="4">
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                                <div class="rating__item"></div>
                            </div>
                            <div class="review-card__body">
                                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів
                                    різних юридичних ресурсів?</p>
                            </div>
                            <div class="review-card__footer"><a class="review-card__more" href="#"
                                                                data-modal="modal-review">Читати детальніше
                                    <svg class="review-card__more-icon" width="8" height="4">
                                        <use xlink:href="/assets/img/sprite.svg#dropdown-arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                </div>
                <button class="button button--outline reviews-slider__prev" type="button" aria-label="previous slide">
                    <svg class="reviews-slider__prev-icon" width="10" height="19">
                        <use xlink:href="/assets/img/sprite.svg#arrow-left"></use>
                    </svg>
                </button>
                <button class="button button--outline reviews-slider__next" type="button" aria-label="next slide">
                    <svg class="reviews-slider__next-icon" width="10" height="19">
                        <use xlink:href="/assets/img/sprite.svg#arrow-right"></use>
                    </svg>
                </button>
                <div class="swiper-pagination reviews-slider__pagination"></div>
            </div>
        </div>
    </section>

    <section class="try-section">
        <div class="container try-section__container">
            <div class="try-section__left">
                <h2 class="section-title try-section__title">Спробуйте наш сервіс всього <span>за 5 $</span> / місяць
                </h2>
                <p class="try-section__descr">Ви заощаджуєте час та зусилля, отримуючи миттєвий доступ до багатої бази
                    статей, які допоможуть вам успішно розумітися на складних юридичних питаннях.</p><a
                    class="button button--white try-section__button" href="#tariffs-section">Спробувати</a>
            </div>
            <div class="try-section__right">
                <picture class="try-section__picture"><img class="try-section__img" src="/assets/img/try-img.webp"
                                                           srcset="/assets/img/try-img@2x.webp 2x" loading="lazy"
                                                           width="452"
                                                           height="312" alt="alt"/></picture>
            </div>
        </div>
    </section>

    <section class="seo-section">
        <div class="container seo-section__container">
            <h2 class="section-title seo-section__title">Про наш сервіс</h2>
            <div class="seo-section__text">
                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних юридичних
                    ресурсів?</p>
                <p>Клінінг – модне слово чи якісно новий рівень чистоти? Все залежить від фахівців, яким Ви довірите
                    наведення порядку.</p>
                <p>Клінінгова компанія CLEANHOUSE (КЛІНХАУС) пропонує широкий спектр послуг з якісного прибирання
                    житлових, офісних та складських приміщень, а також магазинів та торгових площ.</p>
                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних юридичних
                    ресурсів?</p>
                <p>Клінінг – модне слово чи якісно новий рівень чистоти? Все залежить від фахівців, яким Ви довірите
                    наведення порядку.</p>
                <p>Клінінгова компанія CLEANHOUSE (КЛІНХАУС) пропонує широкий спектр послуг з якісного прибирання
                    житлових, офісних та складських приміщень, а також магазинів та торгових площ.</p>
                <p>Вам знайома ситуація, коли Ви шукаєте те, що колись читали, серед тисяч скріншотів різних юридичних
                    ресурсів?</p>
                <p>Клінінг – модне слово чи якісно новий рівень чистоти? Все залежить від фахівців, яким Ви довірите
                    наведення порядку.</p>
                <p>Клінінгова компанія CLEANHOUSE (КЛІНХАУС) пропонує широкий спектр послуг з якісного прибирання
                    житлових, офісних та складських приміщень, а також магазинів та торгових площ.</p>
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
