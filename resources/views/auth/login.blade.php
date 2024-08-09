@extends('layouts.app')
@section('title', 'Вхід')
@section('page')
    <section class="login-section">
        <div class="container login-section__container">
            <div class="login-section__inner">
                <form class="form login-section__form" id="sign-in-form" autocomplete="off" novalidate="novalidate">
                    <h1 class="section-title form__title section-title form__title--mb-15">Вхід</h1>

                    @if ($showLoginButtons)
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
                                <a class="button button--big" href="{{ route('login.driver', 'apple') }}">
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
                    @else
                        <div class="form__group">
                            <div class="form__info">Вхід у вбудованому браузері неможливий</div>
                        </div>
                        <div class="form__group">
                            <div class="form__info">Будь ласка, відкрийте цей сайт у звичайному браузері, як-от Chrome або Safari</div>
                        </div>
                        Скопіюйте та вставте це посилання: <a href="{{ route('login') }}" target="_blank">{{ route('login') }}</a>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection

