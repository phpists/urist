@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 1500px !important;
            width: 100%;
        }
        .input-wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted">Головна</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.criminal_articles.index') }}" class="text-muted">Статті</a>
                </li>
                <li class="breadcrumb-item">
                    Додати статтю
                </li>                <!--end::Page Title-->
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
            @include('admin.layouts.includes.success_message')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Створити</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="createArticleForm" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="createArticleForm" action="{{ route('admin.criminal_articles.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createArticleName">Назва</label>
                                    <div class="input-wrapper">
                                        <input id="createArticleName" type="text" name="name" class="form-control" required/>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="createArticleCategory">Категорія</label>
                                    <div class="input-wrapper">
                                        <select class="required_inp form-control" name="article_category_id" id="createArticleCategory">
                                        </select>
                                        @error('article_category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="courtDecisionLinkInp">Посилання на рішення суду</label>
                                    <div class="input-wrapper">
                                        <input type="text" required class="form-control" name="court_decision_link" id="courtDecisionLinkInp">
                                        @error('court_decision_link')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editArticleTags">Теги</label>
                                    <div class="input-wrapper">
                                        <select multiple="multiple" class="form-control" name="tag_list[]" id="editArticleTags">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label for="descriptionEditor">Короткий опис</label>
                                    <div class="input-wrapper">
                                        <textarea class="required_inp" name="description" id="descriptionEditor"></textarea>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contentEditor">Текст</label>
                                    <div class="input-wrapper">
                                        <textarea class="required_inp" style="height: 600px" id="contentEditor" name="content"></textarea>
                                        @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
    @endsection
@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('js/helpers.js') }} "></script>
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
        function makeEditor(id) {
            return function () {
                // Private functions
                var demos = function () {
                    ClassicEditor
                        .create( document.getElementById( id ) )
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
        }
        document.addEventListener('DOMContentLoaded', function () {
            let descriptionEditor = CKEDITOR.replace( 'descriptionEditor' );
            let contentEditor = CKEDITOR.replace( 'contentEditor' );
            $("#createArticleCategory").select2({
                placeholder: "Виберіть категорію",
                ajax: makeAjaxCategorySearch()
            });
            $("#editArticleTags").select2({
                placeholder: "Виберіть теги",
                ajax: makeSelect2AjaxSearch('/tags/search', 'editArticleTags')
            });
        })
    </script>

@endsection
