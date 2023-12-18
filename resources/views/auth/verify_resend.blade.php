@extends('layouts.app')
@section('title', 'Верифікація')
@section('page')
    <div class="login-section">
        <form class="form" autocomplete="off" action="{{route('verify_phone')}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="phone" value="{{ old('phone',session('phone')) }}">
            <h3 class="section-title form__title">Введіть свій номер телефону</h3>
            <div class="form__group">
                <div class="form__info form__info--big">Код підтвердження надійде вам на телефон</div>
            </div>
            <div class="form__group">
                <input class="input form__input phone-mask @error('phone') just-validate-error-field @enderror"
                       id="inputForgotPhone" type="text"
                       value="{{old('phone')}}"
                       name="phone" placeholder="Номер телефона *" autocomplete="off"/>
                @error('phone')
                <div class="error-label just-validate-error-label">{{$message}}</div>
                @enderror
            </div>
            <div class="form__button-group">
                <button class="button form__button form__button--middle" type="submit">Відправити</button>
            </div>
        </form>
    </div>
@endsection




