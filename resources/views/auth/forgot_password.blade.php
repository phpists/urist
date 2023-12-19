@extends('layouts.app')
@section('title', 'Відновлення паролю')
@section('page')
    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form class="form login-section__form" action="{{route('password.send.code')}}" method="POST">
                    @csrf
                    @method('POST')
                    <h1 class="section-title form__title">Забули пароль?</h1>
                    <div class="form__group">
                        <input class="input form__input phone-mask @error('phone') just-validate-error-field @enderror"
                               id="inputForgotPhone" type="text"
                               value="{{old('phone')}}"
                               name="phone" placeholder="Номер телефона *" autocomplete="off"/>
                        @error('phone')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form__group">
                        <div class="form__info form__info--small">Забули свій пароль? Без проблем. Просто укажіть нам
                            свій номер телефону, і ми надішлемо вам код підтверждення для скидання пароля, за яким ви
                            зможете вибрати новий.
                        </div>
                    </div>
                    <div class="form__button-group form__button-group--sb">
                        <a class="button button--bordered form__button" href="{{route('home')}}">Скасувати
                        </a>
                        <button class="button form__button">Підтвердити</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection






