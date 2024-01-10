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
            </div><a class="button welcome-section__button" href="{{ route('user.articles.index') }}">Перейти у збірник</a>
        </div>
    </section>
@endsection
