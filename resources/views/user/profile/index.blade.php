@extends('layouts.user_app')
@section('title', 'Профіль')
@section('page')
    <section class="profile-section">
        <div class="container profile-section__container">
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
                        <input class="input form__input phone-mask" id="inputPhone" type="text" placeholder="+38 (___) __-__-___" autocomplete="off" value="{{ old('phone', Str::substr($user->phone, 2)) }}" disabled/>
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
                        <select class="select" id="selectCity" name="city" aria-label="Виберіть місто" required="required">
                            <option value="">Виберіть місто</option>
                            <option @selected($user->city == 'Київ')>Київ</option>
                            <option @selected($user->city == 'Одеса')>Одеса</option>
                            <option @selected($user->city == 'Львів')>Львів</option>
                            <option @selected($user->city == 'Харків')>Харків</option>
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
