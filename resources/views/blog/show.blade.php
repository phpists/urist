@extends('layouts.app')
@section('title', $blog->title)
@section('page')
    <section class="top-section">
        <div class="container top-section__container">
            <div class="goal-card">
                <img src="{{ $blog->getThumbnailSrc() }}" alt="" style="width: 100%;">

                <h1>{{ $blog->title }}</h1>

                {!! $blog->content !!}
            </div>
        </div>
    </section>

@endsection
