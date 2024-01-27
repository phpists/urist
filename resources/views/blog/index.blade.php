@extends('layouts.app')
@section('title', 'Блог')
@section('page')
    <section class="blog-section">
        <div class="container blog-section__container">
            <header class="blog-section__header">
                <h1 class="page-title">Блог</h1>
                <nav class="breadcrumbs" aria-label="breadcrumb">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Головна</a></li>
                        <li class="breadcrumbs__item" aria-current="page">Блог</li>
                    </ul>
                </nav>
            </header>
            <nav class="blog-tags blog-section__tags">
                <ul class="blog-tags__list">
                    <li class="blog-tags__item"><a class="button button--outline blog-tags__button @if(!isset($currentBlogTag)) is-active @endif" href="{{ route('blog.index') }}">Усі</a></li>
                    @foreach($blogTags as $blogTag)
                        <li class="blog-tags__item">
                            <a class="button button--outline blog-tags__button @if(isset($currentBlogTag) && request('blogTag') == $blogTag->slug) is-active @endif" href="{{ route('blog.index', $blogTag) }}">
                                {{ $blogTag->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <ul class="blog-section__list">
                @foreach($blog as $article)
                <li class="blog-section__item">
                    <div class="blog-card">
                        <a href="{{ route('blog.show', $article) }}">
                        <picture class="blog-card__picture">
                            <img class="blog-card__img" src="{{ $article->getThumbnailSrc() }}" srcset="{{ $article->getThumbnailSrc() }}" loading="lazy" width="350" height="196" alt="alt"/>
                        </picture>
                        </a>
                        <div class="blog-card__body">
                            <h3 class="blog-card__title">
                                <a class="blog-card__link" href="{{ route('blog.show', $article) }}">{{ $article->title }}</a>
                            </h3>
                            <p>{{ $article->short_description }}</p>
                            <div class="blog-card__bottom">
                                <time class="blog-card__date">{{ $article->date->format('d.m.Y') }}</time>
                                <ul class="blog-card__tags">
                                    @foreach($article->tags as $articleTag)
                                    <li class="blog-card__tags-item">
                                        <a class="blog-card__tags-link" href="{{ route('blog.index', $articleTag) }}">#{{ $articleTag->title }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

            {{ $blog->links('vendor.pagination.front') }}
        </div>
    </section>
@endsection
