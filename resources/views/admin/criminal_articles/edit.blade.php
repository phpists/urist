@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 1500px !important;
            width: 100%;
        }
    </style>
@endsection

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Головна</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.criminal_articles.index') }}" class="text-muted">Статті</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.criminal_article.edit', $criminal_article->id) }}" class="text-muted">Редагування статті</a>
                    </li>
                </ul>                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Редагувати</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="criminal_article_form" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="criminal_article_form" action="{{ route('admin.criminal_articles.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$criminal_article->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createArticleName">Назва</label>
                                    <input id="createArticleName" value="{{$criminal_article->name}}" type="text" name="name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="createArticleCategory">Категорія</label>
                                    <div>
                                        <select class="form-control" name="article_category_id" id="createArticleCategory">
                                            <option selected value="{{$criminal_article->category->id}}">{{$criminal_article->category->name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Текст</label>
                                    <div>
                                        <textarea id="textEditor" name="content">
                                            {{$criminal_article->content}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
        @endsection
        @section('js_after')
            <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
            <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
            <script>
                function makeAjaxCategorySearch() {
                    return {
                        url: '/admin/article_category/search',
                        data: function (params) {
                            var query = {
                                search_string: params.term,
                                article_category_id: null
                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            data = data.map((el) => {
                                return {
                                    id: el.id,
                                    text: el.name
                                }
                            })
                            return {
                                results: data
                            };
                        }
                    }
                }
                document.addEventListener('DOMContentLoaded', function () {
                    var KTCkeditor = function () {
                        // Private functions
                        var demos = function () {
                            ClassicEditor
                                .create( document.querySelector( '#textEditor' ) )
                                .catch( error => {
                                    console.error( error );
                                } );
                        }

                        return {
                            // public functions
                            init: function() {
                                demos();
                            }
                        };
                    }();
                    KTCkeditor.init();
                    $("#createArticleCategory").select2({
                        placeholder: "Виберіть категорію",
                        ajax: makeAjaxCategorySearch()
                    });
                })
            </script>

@endsection
