@extends('layouts.app')
@section('title', 'Блог')
@section('page')
    <section class="blog-section">
    <div class="container blog-section__container">
        <header class="blog-section__header">
            <h1 class="page-title">Блог</h1>
            <nav class="breadcrumbs" aria-label="breadcrumb">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Головна</a></li>
                    <li class="breadcrumbs__item" aria-current="page">Блог</li>
                </ul>
            </nav>
        </header>
        <nav class="blog-tags blog-section__tags">
            <ul class="blog-tags__list">
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button is-active" href="#">Усі</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 1</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 2</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 3</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 4</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 5</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 6</a></li>
                <li class="blog-tags__item"><a class="button button--outline blog-tags__button" href="#">Хештег 7</a></li>
            </ul>
        </nav>
        <ul class="blog-section__list">
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим нашим нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим нашим нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="blog-section__item">
                <div class="blog-card">
                    <picture class="blog-card__picture"><img class="blog-card__img" src="{{asset('assets/img/blog-img.webp')}}" srcset="{{asset('assets/img/blog-img@2x.webp 2x')}}" loading="lazy" width="350" height="196" alt="alt"/></picture>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title"><a class="blog-card__link" href="#">Як користуватись нашим сервісом?</a></h3>
                        <div class="blog-card__bottom">
                            <time class="blog-card__date">21.11.2023</time>
                            <ul class="blog-card__tags">
                                <li class="blog-card__tags-item"><a class="blog-card__tags-link" href="#">#назва тегу</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <nav class="pagenav blog-section__pagenav" aria-label="Page navigation">
            <ul class="pagenav__list">
                <li class="pagenav__item"><a class="pagenav__arrow" href="#" aria-label="Previous">
                        <svg class="pagenav__icon" width="7" height="14">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#arrow-left')}}"></use>
                        </svg></a></li>
                <li class="pagenav__item is-active" aria-current="page"><a class="pagenav__link" href="#">1</a></li>
                <li class="pagenav__item"><a class="pagenav__link" href="#">2</a></li>
                <li class="pagenav__item"><span>...</span></li>
                <li class="pagenav__item"><a class="pagenav__link" href="#">7</a></li>
                <li class="pagenav__item"><a class="pagenav__arrow" href="#" aria-label="Next">
                        <svg class="pagenav__icon" width="7" height="14">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#arrow-right')}}"></use>
                        </svg></a></li>
            </ul>
        </nav>
    </div>
</section>
@endsection
