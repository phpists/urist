@extends('layouts.app')
@section('title', 'Верифікація')
@section('page')
    <div class="login-section">
        <div class="login-section__inner">
            <form class="form" id="code-form" autocomplete="off" action="{{route('password.verify-code')}}" method="POST" novalidate="novalidate">
                @csrf
                @method('POST')
                <input type="hidden" name="phone" value="{{ old('phone',session('phone')) }}">
                <h1 class="section-title form__title">Введіть код</h1>
                <div class="form__group">
                    <div class="form__info form__info--big">Код підтвердження надісланий вам на телефон</div>
                </div>
                <div class="form__group">
                    <div class="form__code">
                        <div class="form__code-item">
                            <input
                                class="input code_input form__input"
                                id="inputCode1"
                                type="text"
                                name="inputCode1"
                                maxlength="1"
                                autocomplete="off"
                                required="required"/>
                        </div>
                        <div class="form__code-item">
                            <input class="code_input input form__input" id="inputCode2" type="text" name="inputCode2" maxlength="1" autocomplete="off" required="required"/>
                        </div>
                        <div class="form__code-item">
                            <input class="input form__input" id="inputCode3" type="text" name="inputCode3" maxlength="1" autocomplete="off" required="required"/>
                        </div>
                        <div class="form__code-item">
                            <input class="code_input input form__input" id="inputCode4" type="text" name="inputCode4" maxlength="1" autocomplete="off" required="required"/>
                        </div>
                        @error('code')
                        <div class="error-label just-validate-error-label" style="display: block !important;">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__group" @error('code') style="margin-top: 30px;" @enderror>
                    <div class="form__info">Не отримали код? <a class="blue-link" href="#" data-modal="login-modal">Відправити ще раз</a></div>
                </div>
                <div class="form__button-group">
                    <button class="button form__button form__button--middle">Відправити</button>
                </div>
            </form>
        </div>
        {{--        <form class="form" id="code-form" autocomplete="off" action="{{route('verify_phone')}}" method="POST">--}}
        {{--            @csrf--}}
        {{--            @method('POST')--}}
        {{--            <input type="hidden" name="phone" value="{{ old('phone',session('phone')) }}">--}}
        {{--            <h3 class="section-title form__title">Введіть код</h3>--}}
        {{--            <div class="form__group">--}}
        {{--                <div class="form__info form__info--big">Код підтвердження надісланий вам на телефон</div>--}}
        {{--            </div>--}}
        {{--            <div class="form__code">--}}
        {{--                <div class="form__group">--}}
        {{--                    <input class="input form__input @error('code') just-validate-error-field @enderror" type="number"--}}
        {{--                           maxlength="4"--}}
        {{--                           id="inputCode"--}}
        {{--                           name="code"--}}
        {{--                           autocomplete="off" required="required"--}}
        {{--                           value="{{ old('code') }}"/>--}}
        {{--                    @error('code')--}}
        {{--                    <div class="error-label just-validate-error-label" style="display: block !important;">{{$message}}</div>--}}
        {{--                    @enderror--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="form__group">--}}
        {{--                <div class="form__info">Не отримали код?--}}
        {{--                    <a class="blue-link" href="#" data-modal="login-modal">Відправити ще раз</a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="form__button-group">--}}
        {{--                <button class="button form__button form__button--middle" type="submit">Відправити</button>--}}
        {{--            </div>--}}
        {{--        </form>--}}
    </div>
@endsection




