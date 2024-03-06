@extends('layouts.user_app')
@section('title', $systemPage->title)
@section('page')
    <section class="welcome-section">
        <div class="container welcome-section__container">
            <picture class="welcome-section__picture">
                <img class="welcome-section__img" src="{{ $systemPage->getImageSrc(0) }}" loading="lazy" width="416" height="401" alt="alt"/>
            </picture>
            <div class="welcome-section__text">
                <p>{{ $systemPage->getDataByDotPath('0.title') }}</p>
            </div><a class="button welcome-section__button" href="{{ $systemPage->getDataByDotPath('0.button_link') }}">{{ $systemPage->getDataByDotPath('0.button_text') }}</a>
        </div>
    </section>
@endsection
