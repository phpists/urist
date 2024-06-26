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
            <div id="message"></div>

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
                    <div class="card-toolbar" style="gap: 10px">
                        <a data-value="{{ $criminal_article->id }}" href="javascript:;" class="btn btn-primary favouriteBtn"
                           data-toggle="modal"
                           data-target="#createFavouriteModal"
                           data-id="{{ $criminal_article->id }}">
                            <i class="far fa-star"></i>
                        </a>
                        <a data-value="{{ $criminal_article->id }}" href="javascript:;" class="btn btn-primary fileBtn"
                           data-toggle="modal"
                           data-target="#createFileModal"
                           data-id="{{ $criminal_article->id }}">
                            <i class="las la-file-export icon-lg"></i>
                        </a>
                        <button type="submit" form="criminal_article_form" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="criminal_article_form" action="{{ route('admin.criminal_articles.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$criminal_article->id}}">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="createArticleName">Назва</label>
                                    <div class="input-wrapper">
                                        <input id="createArticleName" value="{{$criminal_article->name}}" type="text"
                                               data-url="{{ route('admin.criminal-article.check-name') }}"
                                               name="name" class="form-control" required/>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="createArticleName">Відношення</label>
                                    <div class="input-wrapper">
                                        <select class="form-control" name="type" id="createArticleType">
                                            @foreach(\App\Enums\CriminalArticleTypeEnum::cases() as $case)
                                                <option value="{{ $case->value }}" @selected(old('type', $criminal_article->type))>{{ $case->getTitle() }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="editArticleCategory">Категорії</label>
                                    <div class="input-wrapper">
                                        <select class="form-control required_inp" name="article_categories[]" id="editArticleCategory" multiple>
                                            @foreach($criminal_article->categories as $category)
                                                <option selected value="{{ $category->id }}">{{ $category->getFullPath() }}</option>
                                            @endforeach
                                        </select>
                                        @error('article_categories')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="createArticleDate">Дата</label>
                                    <div class="input-wrapper">
                                        <input id="createArticleDate" type="date" name="date" class="form-control" value="{{ $criminal_article->date?->format('Y-m-d') }}" required/>
                                        @error('date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="courtDecisionLinkInp">Посилання на рішення суду</label>
                                    <div class="input-wrapper">
                                        <input value="{{$criminal_article->court_decision_link}}" type="text" class="form-control" name="court_decision_link" id="courtDecisionLinkInp">
                                    </div>
                                    @error('court_decision_link')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editArticleTags">Теги</label>
                                    <div class="input-wrapper">
                                        <select multiple="multiple" class="form-control" name="tag_list[]" id="editArticleTags">
                                            @foreach($criminal_article->tags as $tag)
                                                <option selected value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label for="descriptionEditor">Короткий опис</label>
                                    <div class="input-wrapper">
                                        <textarea class="form-control" name="description" id="descriptionEditor" rows="5" required>{{$criminal_article->description}}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contentEditor">ПП</label>
                                    <div class="input-wrapper">
                                        <textarea class="required_inp" style="height: 600px" id="contentEditor1" name="pp">
                                            {{$criminal_article->pp}}
                                        </textarea>
                                        @error('pp')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contentEditor">Судове рішення</label>
                                    <div class="input-wrapper">
                                        <textarea class="required_inp" style="height: 600px" id="contentEditor2" name="statya_kk">
                                            {{$criminal_article->statya_kk}}
                                        </textarea>
                                        @error('statya_kk')
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
        @include('admin.criminal_articles.parts.add_to_fav_modal')
        @include('admin.criminal_articles.parts.create_file_modal')
        @endsection
        @section('js_after')
            <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
            <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
            <script src="{{ asset('js/helpers.js') }} "></script>
            <script>
                $(function () {

                    $(document).on('keyup', 'input[name="name"]', delay(function (e) {
                        $('#message').html('')
                        let value = this.value;

                        $.ajax({
                            url: this.dataset.url,
                            data: {
                                name: value,
                                id: $('[name="id"]').val()
                            },
                            success: function (response) {
                                if (response && !response.result) {
                                    $('#message').html(`<div class="alert alert-warning" role="alert">${response.message}</div>`)
                                }
                            }
                        })
                    }, 500))

                })

                function makeAjaxCategorySearch() {
                    return {
                        url: '/admin/article_category/search',
                        data: function (params) {
                            var query = {
                                search_string: params.term,
                                page: params.page || 1
                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (response, params) {
                            params.page = params.page || 1;

                            let data = response.data.map((el) => {
                                return {
                                    id: el.id,
                                    text: el.full_path
                                }
                            })

                            console.log(response.next_page_url)

                            return {
                                results: data,
                                pagination: {
                                    more: response.next_page_url != null
                                }
                            };
                        }
                    }
                }
                document.addEventListener('DOMContentLoaded', function () {
                    // let descriptionEditor = CKEDITOR.replace( 'descriptionEditor' );
                    let contentEditor1 = CKEDITOR.replace( 'contentEditor1' );
                    let contentEditor2 = CKEDITOR.replace( 'contentEditor2' );
                    $("#editArticleCategory").select2({
                        placeholder: "Виберіть категорію",
                        ajax: makeAjaxCategorySearch()
                    });
                    $("#editArticleTags").select2({
                        placeholder: "Виберіть теги",
                        ajax: makeSelect2AjaxSearch('/tags/search', 'editArticleTags')
                    });
                    $("#storeFavFolder").select2({
                        placeholder: "Назва папки",
                        ajax: makeSelect2AjaxSearch('/folders/search_favourites', 'storeFavFolder')
                    })
                    $("#storeFileFolder").select2({
                        placeholder: "Назва папки",
                        ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'storeFileFolder')
                    })
                    document.querySelectorAll('.favouriteBtn').forEach((el) => {
                        el.addEventListener('click', function () {
                            document.getElementById('storeFavArticleId').value = el.dataset.id;
                        })
                    });
                    document.querySelectorAll('.fileBtn').forEach((el) => {
                        el.addEventListener('click', function () {
                            document.getElementById('storeFileArticleId').value = el.dataset.id;
                        })
                    });
                })
            </script>

@endsection
