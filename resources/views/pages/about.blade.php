@extends('layouts.app')
@section('title', $systemPage->title ?? 'Про нас')
@section('page')
    <section class="top-section">
        <div class="container top-section__container">
            <header class="faq-section__header">
                <h1 class="page-title">{{ $systemPage->title ?? 'Про нас' }}</h1>
                <nav class="breadcrumbs" aria-label="breadcrumb">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Головна</a></li>
                        <li class="breadcrumbs__item" aria-current="page">{{ $systemPage->title ?? 'Про нас' }}</li>
                    </ul>
                </nav>
            </header>
            <div class="goal-card">
                {!! $systemPage->getDataByDotPath('0.body') !!}
            </div>
        </div>
    </section>
@endsection
