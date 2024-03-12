@extends('layouts.app')
@section('title', $systemPage->title)
@section('page')
    <section class="faq-section">
        <div class="container faq-section__container">
            <header class="faq-section__header">
                <h1 class="page-title">FAQ</h1>
                <nav class="breadcrumbs" aria-label="breadcrumb">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Головна</a></li>
                        <li class="breadcrumbs__item" aria-current="page">FAQ</li>
                    </ul>
                </nav>
            </header>
            <div class="faq-section__row">
                @foreach($systemPage->data as $datum)
                    <div class="faq-section__col">
                        <h2 class="faq-section__sub-title">{{ $datum['title'] }}</h2>
                        <ul class="faq-section__list">
                            @foreach($datum['items'] as $item)
                                @continue(!isset($item['title']))
                                <li class="faq-section__item">
                                    <div class="accordion @if($loop->first) is-open @endif">
                                        <button class="accordion__toggle" type="button" aria-expanded="false">
                                            <div class="accordion__icon"></div>
                                            {{ $item['title'] }}
                                        </button>
                                        <div class="accordion__content" aria-hidden="true">
                                            <div class="accordion__text">
                                                <p>{{ $item['body'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
