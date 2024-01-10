@extends('layouts.user_app')
@section('title', 'Збірник')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page')
    <section class="collection-section">
        <div class="container collection-section__container">
            <h1 class="page-title collection-section__title">Збірник</h1>
            <div class="accordion">
                @include('layouts.partials.categories', compact('categories'))
            </div>
        </div>
    </section>
@endsection

<div class="modal-wrap">
    @include('layouts.user_partials.modal-bookmark')
</div>
