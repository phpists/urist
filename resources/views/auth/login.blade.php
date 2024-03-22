@extends('layouts.app')
@section('title', 'Вхід')
@section('page')
    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form class="form" autocomplete="off" action="{{route('sing-in')}}" method="POST">
                    @csrf
                    @method('POST')
                    <h3 class="section-title form__title">Вхід до кабінету</h3>
                    <div class="form__group">
                        <input class="input form__input phone-mask @error('phone') just-validate-error-field @enderror"
                               id="inputLoginPhone" type="text"
                               name="phone" placeholder="Номер телефона *" autocomplete="off"
                               value="{{ old('phone') }}"
                        />
                        @error('phone')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form__group">
                        <input class="input form__input @error('password') just-validate-error-field @enderror"
                               id="inputLoginPassword" type="password"
                               name="password" placeholder="Пароль *" autocomplete="off"
                            {{ old('password') }}
                        />
                        @error('password')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <input class="checkbox__input" id="checkboxKeep" type="checkbox" name="checkboxKeep"
                               value="true"/>
                        <label class="checkbox__label" for="checkboxKeep">Бути у системі</label>
                    </div>
                    <div class="form__group form__group--sb" style="margin-top: 20px">
{{--                            <a class="form__link blue-link" href="{{route('verify_phone_resend.page')}}">Верифікація номеру</a>--}}
                         <div></div>
                        <a class="form__link blue-link" href="{{route('password.forgot')}}">Забули пароль?</a>
                    </div>
                    <div class="form__group form__group--center">
                        <button class="button form__button form__button--middle" type="submit">Увійти</button>
                    </div>
                    <div class="form__info">Ще не маєте акаунту? <a class="blue-link" href="{{route('register.page')}}"
                                                                    data-modal="login-modal">Зареєструватися</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form class="form login-section__form" id="sign-in-form" autocomplete="off" novalidate="novalidate">
                    <h1 class="section-title form__title section-title form__title--mb-15">Вхід</h1>
                    <div class="form__group">
                        <div class="form__info">за допомогою сервісів</div>
                    </div>
                    <div class="form__row">
                        <div class="form__col">
                            <a class="button button--big" href="{{ route('login.driver', 'google') }}">
                                <svg class="button__icon" width="37" height="38">
                                    <use xlink:href="{{ asset('assets/img/sprite.svg#google') }}"></use>
                                </svg>Google</a>
                        </div>
                        <div class="form__col">
                            <a class="button button--big" href="#">
                                <svg class="button__icon" width="30" height="38">
                                    <use xlink:href="{{ asset('assets/img/sprite.svg#apple') }}"></use>
                                </svg>Apple</a>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__info">Я прочитав і погоджуюся з <a class="blue-link" href="{{ route('policy') }}">Політикою конфіденційності</a></div>
                    </div>
                    <div class="form__group">
                        <div class="form__info">Я прочитав і погоджуюся з <a class="blue-link" href="{{ route('offer') }}">Публічна оферта</a></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

