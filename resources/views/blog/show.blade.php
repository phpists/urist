@extends('layouts.app')
@section('title', $blog->title)
@section('page')
    <section class="top-section">
        <div class="container top-section__container">
            <div class="goal-card" style="min-height: 400px">
                <h1>{{ $blog->title }}</h1>

                <div style="display: flow-root;">
                    <img src="{{ $blog->getThumbnailSrc() }}" alt="" style="width: 20vw; float: left; margin: 0 15px 15px 0">
                {!! $blog->content !!}
                </div>
            </div>
        </div>
    </section>

@endsection
