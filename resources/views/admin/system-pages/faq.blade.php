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

                                <div class="row mb-5">
                                    @foreach($model->data as $i => $datum)
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="data[{{ $i }}][title]" value="{{ old("data.{$i}.title", $model->data[$i]['title']) }}" placeholder="Заголовок" required>
                                            </div>

                                            <hr class="my-8">

                                            @foreach($datum['items'] as $item)
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="data[{{ $i }}][items][{{ $loop->index }}][title]" value="{{ old("data.{$i}.items.{$loop->index}.title", $model->data[$i]['items'][$loop->index]['title']) }}" placeholder="Питання" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <textarea class="form-control" name="data[{{ $i }}][items][{{ $loop->index }}][body]" cols="30" rows="5" placeholder="Відповідь">{{ old("data.{$i}.items.{$loop->index}.title", $model->data[$i]['items'][$loop->index]['title']) }}</textarea>
                                                </div>
                                            </div>

                                                @if(!$loop->last)
                                                    <hr class="my-8">
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
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
@endsection
