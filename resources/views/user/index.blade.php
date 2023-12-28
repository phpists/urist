@extends('layouts.user_app')
@section('title', 'Збірник')
@section('page')
    <section class="welcome-section">
        <div class="container welcome-section__container">
            <picture class="welcome-section__picture">
                <img class="welcome-section__img" src="{{asset('assets/img/user/welcome-img.svg')}}" loading="lazy" width="416" height="401" alt="alt"/>
            </picture>
            <div class="welcome-section__text">
                <p>Ми зібрали для вас безліч правових позицій. Для нас немає нічого важливішого, ніж ваш успіх у юридичній галузі.</p>
            </div><a class="button welcome-section__button" href="#">Перейти у збірник</a>
        </div>
    </section>
    <div class="modal-wrap">
        @include('layouts.user_partials.modal-edit-password')
        @include('layouts.user_partials.modal-success')
        @include('layouts.user_partials.modal-file')
        @include('layouts.user_partials.modal-bookmark')
        @include('layouts.user_partials.modal-create')
        @include('layouts.user_partials.modal-search')
        @include('layouts.user_partials.modal-search-disabled')
        @include('layouts.user_partials.modal-notifications')
        @include('layouts.user_partials.modal-video')
        @include('layouts.user_partials.modal-period')
    </div>
@endsection
