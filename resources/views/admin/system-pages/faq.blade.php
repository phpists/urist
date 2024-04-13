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
                    Системні сторінки
                </li>
                <li class="breadcrumb-item">
                    Редагувати сторінку "{{ $model->title }}"
                </li>
                <!--end::Page Title-->
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
                                <a class="nav-link active" data-toggle="tab" href="#main_tab">
                                    <span class="nav-text">Головна інформація</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#seo_tab">
                                    <span class="nav-text">SEO</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="updateSystemPageForm" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="updateSystemPageForm" action="{{ route('admin.system-pages.update', $model) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="tab-content">

                            <div class="tab-pane fade show active" role="tabpanel" id="main_tab">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-8">
                                    <label for="formTitle">Назва</label>
                                    <div class="input-wrapper">
                                        <input id="formTitle" type="text" name="title" class="form-control" value="{{ old('title', $model->title) }}" required/>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-10">

                                <div id="categoriesRepeater">
                                    <div class="row mb-6" data-repeater-list="data[categories]">
                                        <div data-repeater-item class="col-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="text" class="form-control" name="title"
                                                       placeholder="Заголовок категорії" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-danger" data-repeater-delete><i class="las la-trash"></i></button>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="itemsRepeater mb-8">
                                                <div class="row" data-repeater-list="items">
                                                    <div data-repeater-item class="col-12">
                                                        <div class="form-group mb-2">
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" name="title" placeholder="Питання" required>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-sm btn-danger" data-repeater-delete><i class="las la-trash"></i></button>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Відповідь"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create class="btn btn-outline-info">Додати питання</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" data-repeater-create class="btn btn-outline-primary btn-block">Додати категорію</button>
                                </div>

                            </div>
                        </div>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="seo_tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-8">
                                            <label for="formTitle">Meta Title</label>
                                            <div class="input-wrapper">
                                                <input id="formTitle" type="text" name="meta[title]" class="form-control"
                                                       value="{{ old('meta.title', $model->meta['title'] ?? '') }}"/>
                                                @error('meta.title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="formTitle">Meta Description</label>
                                            <div class="input-wrapper">
                                                <textarea rows="6" class="form-control" name="meta[description]">{!! old('meta.description', $model->meta['description'] ?? '') !!}</textarea>
                                            </div>
                                        </div>
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
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('js/helpers.js') }} "></script>
    <script>

        const $repeater = $('#categoriesRepeater').repeater({
            initEmpty: true,
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.itemsRepeater',
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Ви впевнені, що хочете видалити питання?'))
                        $(this).slideUp(deleteElement);
                }
            }],
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Ви впевнені, що хочете видалити категорію? Всі питання, які вона містить, будуть видалені вслід'))
                    $(this).slideUp(deleteElement);
            }
        });

        $repeater.setList(@json($model->data['categories'] ?? []));
    </script>
@endsection
