@extends('layouts.user_app')
@section('title', 'Збірник')
@section('page')
    <section class="collection-section">
        <div class="container collection-section__container">
            <h1 class="page-title collection-section__title">Збірник</h1>
            <div class="accordion">
                <div class="accordion__panel">
                    <h3 class="accordion__header" id="accordion-header-1">
                        <button class="accordion__trigger" aria-expanded="true" aria-controls="accordion-content-1">КК (в разработке)
                            <svg class="accordion__icon" width="19" height="10">
                                <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                            </svg>
                        </button>
                    </h3>
                    <div class="accordion__content" id="accordion-content-1" role="region" aria-labelledby="accordion-header-1" aria-hidden="false">
                        <div class="accordion__inner">
                            <div class="accordion__panel">
                                <h3 class="accordion__header" id="accordion-header-2">
                                    <button class="accordion__trigger" aria-expanded="true" aria-controls="accordion-content-2">ст. №-№130 Розділ 1 загальні положення
                                        <svg class="accordion__icon" width="19" height="10">
                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="accordion__content" id="accordion-content-2" role="region" aria-labelledby="accordion-header-2" aria-hidden="false">
                                    <div class="accordion__inner">
                                        <div class="accordion__panel">
                                            <h3 class="accordion__header" id="accordion-header-6">
                                                <button class="accordion__trigger" aria-expanded="true" aria-controls="accordion-content-6">ст. 1-6 глава 1 кримінальне процесуальне законодавство
                                                    <svg class="accordion__icon" width="19" height="10">
                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                    </svg>
                                                </button>
                                            </h3>
                                            <div class="accordion__content" id="accordion-content-6" role="region" aria-labelledby="accordion-header-6" aria-hidden="false">
                                                <div class="accordion__inner">
                                                    <div class="accordion__panel">
                                                        <h3 class="accordion__header" id="accordion-header-9">
                                                            <button class="accordion__trigger" aria-expanded="true" aria-controls="accordion-content-9">Ст.1
                                                                <svg class="accordion__icon" width="19" height="10">
                                                                    <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                                </svg>
                                                            </button>
                                                        </h3>
                                                        <div class="accordion__content" id="accordion-content-9" role="region" aria-labelledby="accordion-header-9" aria-hidden="false">
                                                            <div class="accordion__inner">
                                                                <table class="collection-table">
                                                                    <thead class="collection-table__thead">
                                                                    <tr>
                                                                        <th>Дата</th>
                                                                        <th>Назва статті</th>
                                                                        <th>Опис</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody class="collection-table__tbody">
                                                                    <tr>
                                                                        <td>
                                                                            <time class="collection-table__date">27.11.2023</time><span class="collection-table__info">ккс вс</span>
                                                                        </td>
                                                                        <td>
                                                                            <h4 class="collection-table__title">Кримінальне процесуальне законодавство України</h4><a class="blue-link collection-table__link" href="#">Посилання на рішення</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="collection-descr">
                                                                                <div class="collection-descr__text">
                                                                                    <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                                                    <div class="collection-descr__hidden">
                                                                                        <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                                                    </div>
                                                                                </div>
                                                                                <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                                                                                    <svg class="collection-descr__more-icon" width="8" height="4">
                                                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                                                    </svg>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="actions collection-table__actions">
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати">
                                                                                        <svg class="button__icon" width="22" height="22">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#copy')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark">
                                                                                        <svg class="button__icon" width="19" height="24">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Add page" data-tooltip="Створити">
                                                                                        <svg class="button__icon" width="22" height="24">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#create')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Read more" data-tooltip="Перейти">
                                                                                        <svg class="button__icon" width="17" height="12">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <time class="collection-table__date">27.11.2023</time><span class="collection-table__info">ккс вс</span>
                                                                        </td>
                                                                        <td>
                                                                            <h4 class="collection-table__title">Кримінальне процесуальне законодавство України</h4><a class="blue-link collection-table__link" href="#">Посилання на рішення</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="collection-descr">
                                                                                <div class="collection-descr__text">
                                                                                    <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                                                    <div class="collection-descr__hidden">
                                                                                        <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                                                    </div>
                                                                                </div>
                                                                                <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                                                                                    <svg class="collection-descr__more-icon" width="8" height="4">
                                                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                                                    </svg>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="actions collection-table__actions">
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати">
                                                                                        <svg class="button__icon" width="22" height="22">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#copy')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark">
                                                                                        <svg class="button__icon" width="19" height="24">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Add page" data-tooltip="Створити">
                                                                                        <svg class="button__icon" width="22" height="24">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#create')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="actions__item">
                                                                                    <button class="button button--outline actions__button" type="button" aria-label="Read more" data-tooltip="Перейти">
                                                                                        <svg class="button__icon" width="17" height="12">
                                                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                                                                        </svg>
                                                                                    </button>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion__panel">
                                                        <h3 class="accordion__header" id="accordion-header-10">
                                                            <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-10">Ст.1
                                                                <svg class="accordion__icon" width="19" height="10">
                                                                    <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                                </svg>
                                                            </button>
                                                        </h3>
                                                        <div class="accordion__content" id="accordion-content-10" role="region" aria-labelledby="accordion-header-10" aria-hidden="true">
                                                            <div class="accordion__inner">
                                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion__panel">
                                                        <h3 class="accordion__header" id="accordion-header-11">
                                                            <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-11">Ст.1
                                                                <svg class="accordion__icon" width="19" height="10">
                                                                    <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                                </svg>
                                                            </button>
                                                        </h3>
                                                        <div class="accordion__content" id="accordion-content-11" role="region" aria-labelledby="accordion-header-11" aria-hidden="true">
                                                            <div class="accordion__inner">
                                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__panel">
                                            <h3 class="accordion__header" id="accordion-header-7">
                                                <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-7">ст. 1-6 глава 1 кримінальне процесуальне законодавство
                                                    <svg class="accordion__icon" width="19" height="10">
                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                    </svg>
                                                </button>
                                            </h3>
                                            <div class="accordion__content" id="accordion-content-7" role="region" aria-labelledby="accordion-header-7" aria-hidden="true">
                                                <div class="accordion__inner">
                                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__panel">
                                            <h3 class="accordion__header" id="accordion-header-8">
                                                <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-8">ст. 1-6 глава 1 кримінальне процесуальне законодавство
                                                    <svg class="accordion__icon" width="19" height="10">
                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                    </svg>
                                                </button>
                                            </h3>
                                            <div class="accordion__content" id="accordion-content-8" role="region" aria-labelledby="accordion-header-8" aria-hidden="true">
                                                <div class="accordion__inner">
                                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__panel">
                                <h3 class="accordion__header" id="accordion-header-3">
                                    <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-3">ст. №-№130 Розділ 1 загальні положення
                                        <svg class="accordion__icon" width="19" height="10">
                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="accordion__content" id="accordion-content-3" role="region" aria-labelledby="accordion-header-3" aria-hidden="true">
                                    <div class="accordion__inner">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__panel">
                                <h3 class="accordion__header" id="accordion-header-4">
                                    <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-4">ст. №-№130 Розділ 1 загальні положення
                                        <svg class="accordion__icon" width="19" height="10">
                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="accordion__content" id="accordion-content-4" role="region" aria-labelledby="accordion-header-4" aria-hidden="true">
                                    <div class="accordion__inner">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__panel">
                                <h3 class="accordion__header" id="accordion-header-5">
                                    <button class="accordion__trigger" aria-expanded="false" aria-controls="accordion-content-5">ст. №-№130 Розділ 1 загальні положення
                                        <svg class="accordion__icon" width="19" height="10">
                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="accordion__content" id="accordion-content-5" role="region" aria-labelledby="accordion-header-5" aria-hidden="true">
                                    <div class="accordion__inner">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, quo!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
