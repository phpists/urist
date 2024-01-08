@extends('layouts.app')
@section('title', 'Відновлення паролю')
@section('page')
    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form id="password-form" class="form" autocomplete="off" action="{{ route('password.recovery') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <h1 class="section-title form__title">Новий пароль</h1>
                    <div class="form__group">
                        <div class="form__info">Ви вже скинули пароль? <a class="blue-link" href="{{route('login')}}">Увійти</a>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__info"> {{ session('message') }}</a>
                        </div>
                    </div>

                    <div class="form__group">
                        <input class="input form__input @error('password') just-validate-error-field @enderror"
                               type="password" name="password"
                               id="inputNewPassword"
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
                            type="password"
                            id="inputConfirmNewPassword"
                            name="password_confirmation" placeholder="Повторіть пароль *" autocomplete="off"
                        />
                        @error('password_confirmation')
                        <div class="error-label just-validate-error-label">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form__button-group">
                        <button class="button form__button form__button--big" type="submit">Відновити</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
