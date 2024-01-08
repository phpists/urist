@extends('layouts.app')
@section('title', 'Контакти')
@section('page')
    <section class="contacts-section">
        <div class="container contacts-section__container">
            <header class="contacts-section__header">
                <h1 class="page-title">Контакти</h1>
                <nav class="breadcrumbs" aria-label="breadcrumb">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="#">Головна</a></li>
                        <li class="breadcrumbs__item" aria-current="page">Контакти</li>
                    </ul>
                </nav>
            </header>
            <div class="email contacts-section__email">
                <h3 class="email__title">
                    <svg class="email__icon" width="26" height="20">
                        <use xlink:href="/assets/img/sprite.svg#email"></use>
                    </svg>
                    E-mail:
                </h3>
                <a class="email__link" href="mailto:zbirnyk@gmail.com">zbirnyk@gmail.com</a>
            </div>
            <form class="form contacts-section__form" id="feedback-form" autocomplete="off" novalidate="novalidate">
                <div class="form__row">
                    <div class="form__col">
                        <input class="input form__input" id="inputName" type="text" name="inputName"
                               placeholder="Ім’я *" autocomplete="off" required="required"/>
                    </div>
                    <div class="form__col">
                        <input class="input form__input" id="inputEmail" type="email" name="inputEmail"
                               placeholder="Email *" autocomplete="off" required="required"/>
                    </div>
                </div>
                <div class="form__group">
                    <textarea class="textarea form__input" id="textareaFeedback" name="textareaFeedback" rows="8"
                              placeholder="Побажання *" autocomplete="off" required="required"></textarea>
                </div>
                <div class="form__group form__group--center">
                    <div class="checkbox">
                        <input class="checkbox__input" id="checkboxAgree" type="checkbox" name="checkbox" value="true"
                               required="required"/>
                        <label class="checkbox__label" for="checkboxAgree">Погоджуюсь з <a class="blue-link" href="{{route('policy')}}">Політикою
                                конфіденційності</a> та <a class="blue-link" href="{{route('offer')}}">Офертою</a></label>
                    </div>
                </div>
                <div class="form__button-group">
                    <button class="button form__button">Надіслати</button>
                </div>
            </form>
        </div>
    </section>
@endsection
