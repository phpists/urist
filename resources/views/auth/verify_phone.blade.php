@extends('layouts.app')
@section('title', 'Верифікація')
@section('page')
    <div class="login-section">
        <form class="form" autocomplete="off" action="{{route('verify_phone')}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="phone" value="{{ old('phone',session('phone')) }}">
            <h3 class="section-title form__title">Введіть код</h3>
            <div class="form__group">
                <div class="form__info form__info--big">Код підтвердження надісланий вам на телефон</div>
            </div>
            <div class="form__code">
                <div class="form__group">
                    <input class="input form__input @error('code') just-validate-error-field @enderror" type="number"
                           maxlength="4"
                           name="code"
                           autocomplete="off" required="required"
                           value="{{ old('code') }}"/>
                    @error('code')
                    <div class="error-label just-validate-error-label" style="display: block !important;">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__info">Не отримали код?
                    <a class="blue-link" href="#" data-modal="login-modal">Відправити ще раз</a>
                </div>
            </div>
            <div class="form__button-group">
                <button class="button form__button form__button--middle" type="submit">Відправити</button>
            </div>
        </form>
    </div>
@endsection




