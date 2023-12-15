@extends('layouts.app')
@section('page')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{route('sing-in')}}" method="POST">
        @csrf
        @method('POST')
        <div class="input-group">
            <label>Телефон
                <input type="text" name="phone" class="@error('phone')is-invalid @enderror" value="{{ old('phone') }}"
                       id="phone">
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
        <button type="submit">Увійти</button>
    </form>
@endsection

