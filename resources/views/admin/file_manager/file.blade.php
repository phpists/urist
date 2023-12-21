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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted">Головна</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.file_manager.index') }}" class="text-muted">Файловий менеджер</a>
                </li>
                <li class="breadcrumb-item">
                    Редагування файлу
                </li>
                <li class="breadcrumb-item">
                    {{$file->name}}
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
            @include('admin.layouts.includes.messages')
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
                        <button type="submit" form="form1" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form1" action="{{ route('file.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createArticleName">Назва</label>
                                    <input id="createArticleName" type="text" name="name" class="form-control" value="{{$file->name}}" required/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="createFileFolder">Папка</label>
                                    <div>
                                        <select class="form-control" name="folder_id" id="createFileFolder">
                                            <option selected value="{{$file->folder->id}}">{{$file->folder->name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Текст</label>
                                    <div>
                                        <textarea id="textEditor" name="content">{{$file->content}}</textarea>
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
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('js/helpers.js') }} "></script>
    <script>
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
            $("#createFileFolder").select2({
                placeholder: "Виберіть папку",
                ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'createFileFolder')
            })
        })
    </script>

@endsection
