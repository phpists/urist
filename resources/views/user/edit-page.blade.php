@extends('layouts.user_app')
@section('title', 'Редагування файлу')
@section('page')
    <section class="page-section">
        <div class="container page-section__container">
            <header class="page-section__header">
                <div class="page-section__descr">
                    <button class="button button--outline page-section__back-button" type="button" aria-label="Back" data-tooltip="Назад">
                        <svg class="button__icon" width="10" height="19">
                            <use xlink:href="{{asset('assets/img/user/sprite.svg#arrow-left')}}"></use>
                        </svg>
                    </button>
                    <div class="page-section__info">
                        <h1 class="page-title page-section__title">Ст. 1 глава 1 Кримінальне процесуальне законодавство</h1><a class="blue-link page-section__link" href="#">Посилання на рішення </a>
                    </div>
                </div>
            </header>
            <div class="page-section__text">
                <p><strong class="blue-color">Кримінальне процесуальне законодавство України складається з відповідних положень Конституції України, міжнародних договорів, згода на обов’язковість яких надана Верховною Радою України, цього Кодексу та інших законів України.</strong></p>
                <p><strong class="blue-color">Зміни до кримінального процесуального законодавства України можуть вноситися виключно законами про внесення змін до цього Кодексу та/або до законодавства про кримінальну відповідальність, та/або до законодавства України про адміністративні правопорушення.</strong></p>
            </div>
            <div class="page-section__buttons">
                <button class="button page-section__button" type="button">Зберегти</button>
                <button class="button button--outline page-section__button" type="button">Экспорт у Word
                    <svg class="button__icon" width="28" height="28">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#word')}}"></use>
                    </svg>
                </button>
            </div>
            <div class="page-section__editor">Місце для редактора</div>
        </div>
    </section>
@endsection
