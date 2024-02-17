@extends('layouts.user_app')
@section('title', 'Профіль')
@section('page')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection {
            display: flex;
            align-items: center;
            width: 100%;
            height: 50px;
            border-radius: 10px;
            background: var(--white);
            border: 1px solid #D9DDE4;
            box-shadow: none;
            font-size: 16px;
            line-height: 1.2;
            color: var(--black);
            padding: 5px 45px 5px 20px!important;
            font-weight: 400;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            transition: all .5s ease;
        }

        .select2-container .select2-selection__arrow {
            border: none;
            width: 20px!important;
            height: 20px!important;
            margin-top: -10px;
            right: 15px!important;
            background: url("data:image/svg+xml,%3Csvg width='16' height='8' viewBox='0 0 16 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M0.240762 0.349227C0.600184 -0.0700991 1.23148 -0.118661 1.65081 0.240762L8.00002 5.68294L14.3492 0.240762C14.7686 -0.118661 15.3999 -0.0700991 15.7593 0.349227C16.1187 0.768552 16.0701 1.39985 15.6508 1.75927L8.65081 7.75928C8.27632 8.08027 7.72372 8.08027 7.34923 7.75928L0.349227 1.75927C-0.0700991 1.39985 -0.118661 0.768552 0.240762 0.349227Z' fill='%23374E73'/%3E%3C/svg%3E%0A") no-repeat center center;
            transition: all .5s ease;
            top: 50% !important;
        }
        .select2-container .select2-selection__arrow * {
            display: none;
        }
    </style>

    <section class="profile-section">
        <div class="container profile-section__container">
            <div class="filter-toggle">
                <h3 class="filter-toggle__title">Фільтр</h3>
                <button class="button button--outline filter-toggle__button" type="button" aria-label="Hide Filter" data-filter-toggle="data-filter-toggle">
                    <svg class="button__icon" width="20" height="20p">
                        <use xlink:href="img/sprite.svg#filter"></use>
                    </svg>
                </button>
            </div>
            <h1 class="page-title profile-section__title">Мій профіль</h1>
            <form action="{{ route('user.profile.update') }}" method="POST" class="form profile-section__form" id="profile-form" autocomplete="off" novalidate="novalidate">
                @csrf
                @method('PUT')
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Ім’я</label>
                    </div>
                    <div class="form-block__right">
                        <input class="input form__input" id="inputFirstName" type="text" name="first_name" placeholder="Ім’я" autocomplete="off" value="{{ old('first_name', $user->first_name) }}" required="required"/>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Прізвище</label>
                    </div>
                    <div class="form-block__right">
                        <input class="input form__input" id="inputLastName" type="text" name="last_name" placeholder="Прізвище" autocomplete="off" value="{{ old('last_name', $user->last_name) }}" required="required"/>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Email</label>
                    </div>
                    <div class="form-block__right">
                        <input class="input form__input" id="inputEmail" type="email" name="email" placeholder="example@gmail.com" autocomplete="off" value="{{ old('email', $user->email) }}" required="required"/>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Номер телефону</label>
                    </div>
                    <div class="form-block__right">
                        <input class="input form__input phone-mask" id="inputPhone" type="text" placeholder="+38 (___) __-__-___" autocomplete="off" value="{{ old('phone', Str::substr($user->phone, 2)) }}" style="text-align: initial" disabled/>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Дата народження</label>
                    </div>
                    <div class="form-block__right">
                        <input class="input form__input" id="inputDate" type="date" name="birth_date" placeholder="" autocomplete="off" value="{{ old('birth_date', $user->birth_date) }}" required="required"/>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left">
                        <label class="form-block__label">Місто</label>
                    </div>
                    <div class="form-block__right">
                        <select class="city-select" id="selectCity" name="city"
                                data-url="{{ route('user.profile.search-city') }}"
                                aria-label="Виберіть місто" required="required">
                            @if($user->city)
                            <option selected>{{ $user->city }}</option>
                            @endif
                            <option @selected($user->city == 'Київ')>Київ</option>
                            <option @selected($user->city == 'Харків')>Харків</option>
                            <option @selected($user->city == 'Одеса')>Одеса</option>
                            <option @selected($user->city == 'Дніпро')>Дніпро</option>
                            <option @selected($user->city == 'Донецьк')>Донецьк</option>
                            <option @selected($user->city == 'Запоріжжя')>Запоріжжя</option>
                            <option @selected($user->city == 'Львів')>Львів</option>
                            <option @selected($user->city == 'Кривий Ріг')>Кривий Ріг</option>
                            <option @selected($user->city == 'Миколаїв')>Миколаїв</option>
                            <option @selected($user->city == 'Севастополь')>Севастополь</option>
                            <option @selected($user->city == 'Маріуполь')>Маріуполь</option>
                            <option @selected($user->city == 'Луганськ')>Луганськ</option>
                            <option @selected($user->city == 'Вінниця')>Вінниця</option>
                            <option @selected($user->city == 'Сімферополь')>Сімферополь</option>
                            <option @selected($user->city == 'Макіївка')>Макіївка</option>
                            <option @selected($user->city == 'Херсон')>Херсон</option>
                            <option @selected($user->city == 'Чернігів')>Чернігів</option>
                            <option @selected($user->city == 'Полтава')>Полтава</option>
                            <option @selected($user->city == 'Хмельницький')>Хмельницький</option>
                            <option @selected($user->city == 'Черкаси')>Черкаси</option>
                            <option @selected($user->city == 'Чернівці')>Чернівці</option>
                            <option @selected($user->city == 'Житомир')>Житомир</option>
                            <option @selected($user->city == 'Суми')>Суми</option>
                            <option @selected($user->city == 'Рівне')>Рівне</option>
                            <option @selected($user->city == 'Горлівка')>Горлівка</option>
                            <option @selected($user->city == 'Івано-Франківськ')>Івано-Франківськ</option>
                            <option @selected($user->city == 'Кам\'янське')>Кам'янське</option>
                            <option @selected($user->city == 'Кропивницький')>Кропивницький</option>
                            <option @selected($user->city == 'Тернопіль')>Тернопіль</option>
                            <option @selected($user->city == 'Луцьк')>Луцьк</option>
                        </select>
                    </div>
                </div>
                <div class="form-block">
                    <div class="form-block__left"></div>
                    <div class="form-block__right">
                        <div class="form__buttons-group">
                            <button type="submit" class="button form__button">Зберегти</button>
                            <button class="button button--outline form__button" type="button" data-modal="modal-edit-password">Редагувати пароль</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

<div class="modal-wrap">
    <div class="modal" id="modal-edit-password">
        <div class="modal__inner">
            <div class="modal__window">
                <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                    <svg class="modal__close-icon" width="23" height="22">
                        <use xlink:href="img/sprite.svg#close-modal"></use>
                    </svg>
                </button>
                <h3 class="modal__title">Редагувати пароль</h3>
                <form action="{{ route('user.profile.change-password') }}" method="POST" class="form modal__form" id="edit-password-form" autocomplete="off" novalidate="novalidate">
                    @csrf
                    <div class="form__group">
                        <input class="input form__input" id="inputEditPassword" type="password" name="old_password" placeholder="Старий пароль" autocomplete="off" required="required"/>
                    </div>
                    <div class="form__group">
                        <input class="input form__input" id="inputEditNewPassword" type="password" name="new_password" placeholder="Новий пароль" autocomplete="off" required="required"/>
                    </div>
                    <div class="form__group">
                        <input class="input form__input" id="inputEditRepeatPassword" type="password" name="new_password_confirmation" placeholder="Повторити пароль" autocomplete="off" required="required"/>
                    </div>
                    <div class="form__buttons-group form__buttons-group--center">
                        <button class="button form__button modal__button">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/uk.js"></script>
    <script src="{{ asset('user/js/profile.js') }}"></script>
@endpush
