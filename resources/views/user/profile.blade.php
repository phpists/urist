@extends('layouts.user_app')
@section('title', 'Профіль')
@section('page')
    <section class="profile-section">
    <div class="container profile-section__container">
        <h1 class="page-title profile-section__title">Мій профіль</h1>
        <form class="form profile-section__form" id="profile-form" autocomplete="off" novalidate="novalidate">
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Ім’я</label>
                </div>
                <div class="form-block__right">
                    <input class="input form__input" id="inputFirstName" type="text" name="inputFirstName" placeholder="Ім’я" autocomplete="off" required="required"/>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Прізвище</label>
                </div>
                <div class="form-block__right">
                    <input class="input form__input" id="inputLastName" type="text" name="inputLastName" placeholder="Прізвище" autocomplete="off" required="required"/>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Email</label>
                </div>
                <div class="form-block__right">
                    <input class="input form__input" id="inputEmail" type="email" name="inputEmail" placeholder="example@gmail.com" autocomplete="off" required="required"/>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Номер телефону</label>
                </div>
                <div class="form-block__right">
                    <input class="input form__input phone-mask" id="inputPhone" type="text" name="inputPhone" placeholder="+38 (___) __-__-___" autocomplete="off" required="required"/>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Дата народження</label>
                </div>
                <div class="form-block__right">
                    <input class="input form__input" id="inputDate" type="date" name="inputDate" placeholder="" autocomplete="off" required="required"/>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left">
                    <label class="form-block__label">Місто</label>
                </div>
                <div class="form-block__right">
                    <select class="select" id="selectCity" name="selectCity" aria-label="Виберіть місто" required="required">
                        <option value="">Виберіть місто</option>
                        <option value="1">Київ</option>
                        <option value="2">Одеса</option>
                        <option value="3">Львів</option>
                        <option value="4">Харків</option>
                    </select>
                </div>
            </div>
            <div class="form-block">
                <div class="form-block__left"></div>
                <div class="form-block__right">
                    <div class="form__buttons-group">
                        <button class="button form__button">Зберегти</button>
                        <button class="button button--outline form__button" type="button" data-modal="modal-edit-password">Редагувати пароль</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
