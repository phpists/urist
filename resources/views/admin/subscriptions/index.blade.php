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
                    Тарифи
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
            @include('admin.layouts.includes.messages')
            <div class="row" style="row-gap: 10px">
                @foreach($roles as $role)
                    <div class="col-md-6">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h1 class="card-title text-center font-weight-bold">Тариф: {{$role->name}}</h1>
                            </div>
                            <div class="card-body">
                                <p class="text-center font-weight-bolder font-size-h4">Список функцій</p>
                                <div class="mt-15">
                                    <ul>
                                        @foreach($permissions as $permission)
                                            <li class="row mb-5">
                                                <div class="col-9">
                                                    <p class="font-size-h5">{{\Illuminate\Support\Facades\Lang::get('subscription.'.$permission->name)}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <span class="justify-content-end switch switch-outline switch-icon switch-info">
                                                        <label>
                                                            <input class="permissionCheckBox" data-role="{{$role->id}}" data-permission="{{$permission->id}}" type="checkbox" @if($role->hasPermissionTo($permission->name)) checked="checked" @endif name="is_active"/>
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
{{--            <div class="card card-custom">--}}
{{--                <div class="card-header card-header-tabs-line">--}}
{{--                    <div class="card-toolbar">--}}
{{--                        <ul class="nav nav-tabs nav-bold nav-tabs-line">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">--}}
{{--                                    <span class="nav-text">Створити</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="card-toolbar">--}}
{{--                        <button type="submit" form="form1" class="btn btn-primary">Зберегти</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <form id="form1" action="{{ route('file.update') }}" method="POST"--}}
{{--                          enctype="multipart/form-data">--}}
{{--                        @method('put')--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="file_id" value="{{$file->id}}">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="createArticleName">Назва</label>--}}
{{--                                    <input id="createArticleName" type="text" name="name" class="form-control" value="{{$file->name}}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="createFileFolder">Папка</label>--}}
{{--                                    <div>--}}
{{--                                        <select class="form-control" name="folder_id" id="createFileFolder">--}}
{{--                                            <option selected value="{{$file->folder->id}}">{{$file->folder->name}}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Текст</label>--}}
{{--                                    <div>--}}
{{--                                        <textarea id="textEditor" name="content">{{$file->content}}</textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--end::Container-->
        </div>
    </div>
@endsection
@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('js/helpers.js') }} "></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            $('.permissionCheckBox').each((idx, el) => {
                el.addEventListener('change', (ev) => {
                    let checkBoxEl = ev.currentTarget;
                    $.ajax({
                        method: 'POST',
                        url: '/admin/subscriptions/update_permission',
                        data: {
                            permission_id: checkBoxEl.dataset.permission,
                            role_id: checkBoxEl.dataset.role,
                            is_active: (+ checkBoxEl.checked)
                        },
                        success: function (resp) {
                            console.log(resp)
                        }
                    })
                })
            })
        })
    </script>

@endsection
