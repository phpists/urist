@extends('layouts.user_app')
@section('title', 'Редагування файлу')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor.css') }}">
@endpush

@section('page')
    <section class="page-section">
        <div class="container page-section__container">
            <header class="page-section__header">
                <div class="page-section__descr">
                    <a href="{{ url()->previous() }}" class="button button--outline page-section__back-button"
                       type="button" aria-label="Back" data-tooltip="Назад">
                        <svg class="button__icon" width="10" height="19">
                            <use xlink:href="{{ asset('assets/img/user/sprite.svg#arrow-left') }}"></use>
                        </svg>
                    </a>
                    <div class="page-section__info">
                        <h1 class="page-title page-section__title">{{ $article->name }}</h1>
                        @if($article->date)
                            <time class="page-section__date">{{ $article->pretty_date }}</time>
                        @endif
                        <ul class="page-section__tags">
                            @foreach($article->getTagsArray() as $tag)
                                <li class="page-section__tags-item">{{ $tag }}</li>
                            @endforeach
                        </ul>
                        @if($article->court_decision_link)
                            <a class="blue-link page-section__link" href="{{ $article->court_decision_link }}"
                               target="_blank">Посилання на рішення </a>
                        @endif
                    </div>
                </div>
                <ul class="actions page-section__actions">
                    @if(can_user(\App\Enums\PermissionEnum::CREATE_BOOKMARKS->value))
                        <li class="actions__item">
                            <button class="button button--outline actions__button modal-self-completing" type="button"
                                    aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark"
                                    data-json='@json(['criminal_article_id' => $article->id])'>
                                <svg class="button__icon" width="19" height="24">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#bookmark') }}"></use>
                                </svg>
                            </button>
                        </li>
                    @endif

                    @if(can_user(\App\Enums\PermissionEnum::CREATE_OWN_PAGES->value))
                        <li class="actions__item">
                            <button class="button button--outline actions__button modal-self-completing" type="button"
                                    aria-label="Add page" data-tooltip="Робота з файлом"
                                    data-json='@json(['criminal_article_id' => $article->id, 'name' => htmlspecialchars($article->name)])'
                                    data-modal="modal-file">
                                <svg class="button__icon" width="22" height="24">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#create') }}"></use>
                                </svg>
                            </button>
                        </li>
                    @endif
                    @if(can_user(\App\Enums\PermissionEnum::COPY_PAGE->value))
                        <li class="actions__item">
                            <button class="button button--outline actions__button" type="button" aria-label="Copy"
                                    data-tooltip="Копіювати"
                                    onclick="copyText('{{ route('user.articles.show', $article) }}')">
                                <svg class="button__icon" width="22" height="22">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#copy') }}"></use>
                                </svg>
                            </button>
                        </li>
                    @endif
                    @if(can_user(\App\Enums\PermissionEnum::EXPORT_PAGE->value))
                        <li class="actions__item">
                            <a href="{{ route('user.articles.export-doc', $article) }}"
                               class="button button--outline actions__button" type="button" aria-label="Word"
                               data-tooltip="Word">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_968_2237)">
                                        <path d="M21.7777 28H6.2222C4.5603 28 2.99778 27.3528 1.82248 26.1775C0.647233 25.0023 0 23.4398 0 21.7777V20.2221C0 19.363 0.69641 18.6665 1.55556 18.6665C2.41472 18.6665 3.11113 19.363 3.11113 20.2221V21.7777C3.11113 22.6087 3.43477 23.39 4.02229 23.9775C4.60996 24.5652 5.3912 24.8889 6.2222 24.8889H21.7777C22.6087 24.8889 23.3899 24.5652 23.9775 23.9775C24.5652 23.3899 24.8889 22.6086 24.8889 21.7777V20.2221C24.8889 19.363 25.5853 18.6665 26.4444 18.6665C27.3035 18.6665 28 19.363 28 20.2221V21.7777C28 23.4396 27.3528 25.0021 26.1775 26.1775C25.0022 27.3528 23.4396 28 21.7777 28ZM14 21.7777C13.7848 21.7777 13.5799 21.734 13.3935 21.655C13.2197 21.5816 13.0563 21.4749 12.9133 21.3353C12.9132 21.3352 12.9132 21.3351 12.9132 21.3351C12.9122 21.3342 12.9111 21.3331 12.9101 21.3321C12.9098 21.3319 12.9095 21.3315 12.9092 21.3312C12.9084 21.3305 12.9076 21.3297 12.9068 21.3288C12.9062 21.3283 12.9057 21.3279 12.9052 21.3273C12.9047 21.3267 12.904 21.326 12.9035 21.3256C12.9024 21.3245 12.9012 21.3233 12.9001 21.3222L6.67784 15.0999C6.07038 14.4924 6.07038 13.5075 6.67784 12.9C7.28529 12.2925 8.2703 12.2925 8.87775 12.9L12.4445 16.4667V1.55556C12.4444 0.69641 13.1408 0 14 0C14.8591 0 15.5556 0.69641 15.5556 1.55556V16.4666L19.1222 12.9C19.7296 12.2925 20.7148 12.2925 21.3222 12.9C21.9296 13.5074 21.9296 14.4924 21.3222 15.0999L15.0999 21.3221C15.0988 21.3232 15.0976 21.3244 15.0965 21.3255C15.0959 21.326 15.0953 21.3267 15.0948 21.3272C15.0943 21.3278 15.0938 21.3282 15.0932 21.3287C15.0925 21.3296 15.0916 21.3304 15.0908 21.3311C15.0906 21.3314 15.0902 21.3318 15.0899 21.332C15.0889 21.333 15.0879 21.3341 15.0869 21.335C15.0868 21.335 15.0868 21.3351 15.0868 21.3351C15.0696 21.3518 15.0523 21.368 15.0346 21.3838C14.9043 21.5 14.7593 21.5905 14.6059 21.6552C14.6053 21.6554 14.6049 21.6556 14.6043 21.6559C14.6037 21.6561 14.6032 21.6564 14.6026 21.6566C14.4172 21.7347 14.2137 21.7777 14 21.7777Z" fill="#374E73" style="fill:#374E73;fill:color(display-p3 0.2157 0.3059 0.4510);fill-opacity:1;"/>
                                        <path d="M14.0004 21.7777C13.7852 21.7777 13.5803 21.734 13.394 21.655C13.2201 21.5816 13.0567 21.4749 12.9137 21.3353L12.9105 21.3321L12.9096 21.3312L12.9072 21.3288L12.9056 21.3273L12.9039 21.3256L12.9005 21.3222L6.67825 15.0999C6.07079 14.4924 6.07079 13.5075 6.67825 12.9C7.28571 12.2925 8.27071 12.2925 8.87817 12.9L12.4449 16.4667V1.55556C12.4448 0.69641 13.1412 0 14.0004 0C14.8595 0 15.556 0.69641 15.556 1.55556V16.4666L19.1227 12.9C19.7301 12.2925 20.7152 12.2925 21.3226 12.9C21.93 13.5074 21.93 14.4924 21.3226 15.0999L15.1003 21.3221L15.0969 21.3255L15.0952 21.3272L15.0936 21.3287L15.0912 21.3311L15.0903 21.332L15.0873 21.335C15.0702 21.3517 15.0527 21.368 15.035 21.3838C14.9047 21.5 14.7597 21.5905 14.6063 21.6552L14.6047 21.6559L14.6031 21.6566C14.4177 21.7346 14.2141 21.7777 14.0004 21.7777Z" fill="#374E73" style="fill:#374E73;fill:color(display-p3 0.2157 0.3059 0.4510);fill-opacity:1;"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_968_2237">
                                            <rect width="28" height="28" fill="white" style="fill:white;fill-opacity:1;"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </header>
            <div class="tabs page-section__tabs" data-tabs="tabs-1" data-active="0">
                <ul class="tabs__nav">
                    <li class="tabs__nav-item">
                        <button class="button button--outline tabs__nav-btn" type="button">ПП</button>
                    </li>
                    <li class="tabs__nav-item">
                        <button class="button button--outline tabs__nav-btn" type="button">Судове рішення</button>
                    </li>
                </ul>
            </div>
            <div class="tabs-content page-section__tabs-content" data-tabs-content="tabs-1">
                <div class="tabs-panel">
                    <div class="page-section__text">
                        {!! $article->pp !!}
                    </div>
                </div>
                <div class="tabs-panel">
                    <div class="page-section__text ck-content" style="overflow: hidden">
                        {!! $article->statya_kk !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('modals')
    @include('layouts.user_partials.modal-bookmark')
    @include('layouts.user_partials.modal-file')
@endpush
