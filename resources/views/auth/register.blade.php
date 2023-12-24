@extends('layouts.app')
@section('title', 'Реєстрація')
@push('scripts_head')
    {!! NoCaptcha::renderJs(app()->getLocale()) !!}
@endpush
@section('page')
    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form class="form login-section__form" autocomplete="off"
                      action="{{route('sing-up')}}" id="registration-form" method="POST">
                    @csrf
                    @method('POST')
                    <h1 class="section-title form__title">Реєстрація</h1>
                    <div class="form__group">
                        <input
                            id="inputRegName"
                            class="input form__input @error('name') just-validate-error-field @enderror"
                            type="text"
                            value="{{ old('name') }}"
                            name="name" placeholder="Ім’я *">
                        @error('name')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form__group">
                        <input class="input form__input phone-mask  @error('phone') just-validate-error-field @enderror"
                               id="inputRegPhone" type="text" name="phone"
                               value="{{ old('phone') }}"
                               placeholder="Номер телефона *"/>
                        @error('phone')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form__group">
                        <input class="input form__input @error('password') just-validate-error-field @enderror"
                               id="inputRegPassword" type="password" name="password"
                               value="{{ old('password') }}"
                               placeholder="Пароль *"/>
                        @error('password')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>


                    <div class="form__group">
                        <div class="form-pass">
                            <div class="form-pass__power" data-pass-power="0">
                                <div class="form-pass__item"></div>
                                <div class="form-pass__item"></div>
                                <div class="form-pass__item"></div>
                                <div class="form-pass__item"></div>
                            </div>
                            <div class="form-pass__text">Використовуйте 8 або більше символів із поєднанням літер, цифр
                                і символів
                            </div>
                        </div>
                    </div>
                    <div class="form__group">
                        <input
                            class="input form__input @error('password_confirmation') just-validate-error-field @enderror"
                            id="inputConfirmRegPassword" type="password" name="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                            placeholder="Повторіть пароль *"/>
                        @error('password_confirmation')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>


                    <div class="form__group">
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                        <div class="error-label just-validate-error-label">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form__group">
                        <div class="checkbox">
                            <input class="checkbox__input @error('policy') just-validate-error-field @enderror"
                                   id="checkboxRegAgree" type="checkbox" name="policy"
                                   value="true" {{ old('policy') ? 'checked' : '' }}/>
                            <label class="checkbox__label" for="checkboxRegAgree">Я прочитав і погоджуюся з <a
                                    class="blue-link" href="{{route('policy')}}">Політикою
                                    конфіденційності</a></label>
                        </div>
                    </div>

                    <div class="form__group">
                        <div class="checkbox">
                            <input class="checkbox__input @error('offer') just-validate-error-field @enderror"
                                   id="checkboxRegAccept" type="checkbox"
                                   name="offer" value="true" {{ old('offer') ? 'checked' : '' }}/>
                            <label class="checkbox__label" for="checkboxRegAccept">Я прочитав і погоджуюся з <a
                                    class="blue-link" href="{{route('offer')}}">Публічна оферта</a></label>
                        </div>
                    </div>
                    <div class="form__group">
                        <button class="button form__button form__button--big" type="submit">Зареєструватися</button>
                    </div>
                    <div class="form__info">У вас вже є акаунт? <a class="blue-link"
                                                                   href="{{route('login')}}">Увійти</a>
                    </div>
                    @error('password')
                    <div class="form__info">
                        <a class="form__link blue-link" href="{{route('verify_phone_resend.page')}}">Верифікація номеру</a>
                    </div>
                    @enderror
                </form>
            </div>
        </div>
    </section>
@endsection
