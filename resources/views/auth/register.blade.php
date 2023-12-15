@extends('layouts.app')
@push('scripts_head')
    {!! NoCaptcha::renderJs(app()->getLocale()) !!}
@endpush
@section('page')
    <form action="{{route('sing-up')}}" method="POST">
        @csrf
        @method('POST')
        <div class="input-group">
            <label>Телефон
                <input type="text" name="phone" class="@error('phone')is-invalid @enderror" value="{{ old('phone') }}" id="phone">
                @error('phone')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            </label>
        </div>
        <div class="input-group">
            <label>Пароль
                <input type="password" name="password"
                       class="@error('password') is-invalid @enderror"
                       autocomplete="on"
                       value="{{ old('password') }}">
                @error('password')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="input-group">
            <label>Підтвердження паролю
                <input type="password" name="password_confirmation"
                       class="@error('password_confirmation') is-invalid @enderror"
                       autocomplete="on"
                       value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="input-group">
            <label>
                <input type="checkbox" name="policy"
                       class="@error('policy') is-invalid @enderror" {{ old('policy') ? 'checked' : '' }}>
                Я прочитав(а) і погоджуюсь з <a href="#">Договором публічної оферти</a> та <a href="#">Політикою
                    конфіденційності</a>
                @error('policy')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="input-group">
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
            <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Відправити</button>
    </form>
@endsection

