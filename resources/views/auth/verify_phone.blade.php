@extends('layouts.app')
@section('page')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{route('verify_phone')}}" method="POST">
        @csrf
        @method('POST')
        <div class="input-group">
            <label>Код підтвердження
                <input type="text" name="code" id="code" class="@error('code')is-invalid @enderror"
                       value="{{ old('code') }}">
                @error('code')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            </label>
        </div>
        <input type="hidden" name="phone" value="{{ old('phone',session('phone')) }}">
        <button type="submit">Підтвердити</button>
    </form>
@endsection

@push('scripts_footer')
    <script>
        $(document).ready(function () {
            $('#code').inputmask({
                mask: '9999',
                placeholder: '____',
                clearMaskOnLostFocus: false
            });
        });
    </script>
@endpush
