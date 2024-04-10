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
                    <form id="updateSystemPageForm" action="{{ route('admin.system-pages.update', $model) }}"
                          method="POST"
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
                                                <input id="formTitle" type="text" name="title" class="form-control"
                                                       value="{{ old('title', $model->title) }}" required/>
                                                @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="data[0][title]"
                                                           value="{{ old('data.0.title', $model->data[0]['title']) }}"
                                                           placeholder="Заголовок" required>
                                                    <span class="form-text text-muted">Обрамте текст символами "<" i ">" щоб висвітлити текст</span>
                                                </div>
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control" name="data[0][body]"
                                                              placeholder="Вміст"
                                                              required>{{ old('data.0.body', $model->data[0]['body']) }}</textarea>
                                                    <span class="form-text text-muted">Обрамте текст символами "<" i ">" щоб висвітлити текст</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[0][button_text]"
                                                                       value="{{ old('data.0.button_text', $model->data[0]['button_text']) }}"
                                                                       placeholder="Текст кнопки" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[0][button_link]"
                                                                       value="{{ old('data.0.button_link', $model->data[0]['button_link']) }}"
                                                                       placeholder="Посилання кнопки" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="image-input image-input-outline" id="thumbnailImage">
                                                    <div class="image-input-wrapper"
                                                         style="background-image: url({{ old('images.0', $model->getImageSrc(0)) }})"></div>

                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="images[0]" accept=".png, .jpg, .jpeg"/>
                                                    </label>

                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel" data-toggle="tooltip"
                                                        title="Cancel avatar">
		<i class="ki ki-bold-close icon-xs text-muted"></i>
	</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="w-75 my-10">

                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <input type="text" class="form-control" name="data[1][title]"
                                                               value="{{ old('data.1.title', $model->data[1]['title']) }}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][0][icon]"
                                                                       value="{{ old('data.1.items.0.icon', $model->data[1]['items'][0]['icon']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][0][title]"
                                                                       value="{{ old('data.1.items.0.title', $model->data[1]['items'][0]['title']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <textarea rows="6" class="form-control ckeditor"
                                                                          name="data[1][items][0][body]"
                                                                          required>{!! old('data.1.items.0.body', $model->data[1]['items'][0]['body']) !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][1][icon]"
                                                                       value="{{ old('data.1.items.1.icon', $model->data[1]['items'][1]['icon']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][1][title]"
                                                                       value="{{ old('data.1.items.1.title', $model->data[1]['items'][1]['title']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <textarea rows="6" class="form-control ckeditor"
                                                                          name="data[1][items][1][body]"
                                                                          required>{!! old('data.1.items.1.body', $model->data[1]['items'][1]['body']) !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][2][icon]"
                                                                       value="{{ old('data.1.items.2.icon', $model->data[1]['items'][2]['icon']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][2][title]"
                                                                       value="{{ old('data.1.items.2.title', $model->data[1]['items'][2]['title']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <textarea rows="6" class="form-control ckeditor"
                                                                          name="data[1][items][2][body]"
                                                                          required>{!! old('data.1.items.2.body', $model->data[1]['items'][2]['body']) !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][3][icon]"
                                                                       value="{{ old('data.1.items.3.icon', $model->data[1]['items'][3]['icon']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <input type="text" class="form-control"
                                                                       name="data[1][items][3][title]"
                                                                       value="{{ old('data.1.items.3.title', $model->data[1]['items'][3]['title']) }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-wrapper">
                                                                <textarea rows="6" class="form-control ckeditor"
                                                                          name="data[1][items][3][body]"
                                                                          required>{!! old('data.1.items.3.body', $model->data[1]['items'][3]['body']) !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr class="w-75 my-10">

                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <input type="text" class="form-control" name="data[2][title]"
                                                               value="{{ old('data.2.title', $model->data[2]['title']) }}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][0]"
                                                                  required>{{ old('data.2.items.0', $model->data[2]['items'][0]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][1]"
                                                                  required>{{ old('data.2.items.1', $model->data[2]['items'][1]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][2]"
                                                                  required>{{ old('data.2.items.2', $model->data[2]['items'][2]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][3]"
                                                                  required>{{ old('data.2.items.3', $model->data[2]['items'][3]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][4]"
                                                                  required>{{ old('data.2.items.4', $model->data[2]['items'][4]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][5]"
                                                                  required>{{ old('data.2.items.5', $model->data[2]['items'][5]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <textarea rows="6" class="form-control" name="data[2][items][6]"
                                                                  required>{{ old('data.2.items.6', $model->data[2]['items'][6]) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="w-75 my-10">

                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <div class="input-wrapper">
                                                        <input type="text" class="form-control" name="data[3][title]"
                                                               value="{{ old('data.3.title', $model->data[3]['title']) }}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @for($i = 0; $i < 8; $i++)
                                                <div class="col-12">
                                                    <input type="hidden" name="data[3][items][{{ $i }}][img]"
                                                           value="{{ $model->data[3]['items'][$i]['img'] ?? '' }}">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            <div class="image-input image-input-outline kt-image"
                                                                 style="width: 100%;">
                                                                <div class="image-input-wrapper"
                                                                     style="background-image: url('{{ $model->getDataImgSrcByDot("3.items.{$i}.img") }}'); width: 100%"></div>

                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file"
                                                                           name="data[3][items][{{ $i }}][img]"
                                                                           accept="image/*,image/webp"/>
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>АБО IFrame код</label>
                                                                <div class="input-wrapper">
                                                                    <input type="text" class="form-control"
                                                                           name="data[3][items][{{ $i }}][iframe]"
                                                                           value="{{ old("data.3.items.{$i}.iframe", $model->data[3]['items'][$i]['iframe'] ?? '') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-group">
                                                                <div class="input-wrapper">
                                                                    <input type="text" class="form-control"
                                                                           name="data[3][items][{{ $i }}][title]"
                                                                           value="{{ old("data.3.items.{$i}.title", $model->data[3]['items'][$i]['title']) }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="input-wrapper">
                                                                    <input type="text" class="form-control"
                                                                           name="data[3][items][{{ $i }}][quote]"
                                                                           value="{{ old("data.3.items.{$i}.quote", $model->data[3]['items'][$i]['quote']) }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="input-wrapper">
                                                                    <textarea rows="6" class="form-control ckeditor"
                                                                              name="data[3][items][{{ $i }}][body]"
                                                                              required>{!! old("data.3.items.{$i}.body", $model->data[3]['items'][$i]['body']) !!}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>

                                        <hr class="w-75 my-10">

                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="data[4][title]"
                                                           value="{{ old('data.4.title', $model->data[4]['title']) }}"
                                                           placeholder="Заголовок" required>
                                                    <span class="form-text text-muted">Обрамте текст символами "<" i ">" щоб висвітлити текст</span>
                                                </div>
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control" name="data[4][body]"
                                                              placeholder="Вміст"
                                                              required>{{ old('data.4.body', $model->data[4]['body']) }}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <input type="text" class="form-control"
                                                               name="data[4][button_text]"
                                                               value="{{ old('data.4.button_text', $model->data[4]['button_text']) }}"
                                                               placeholder="Текст кнопки" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <input type="text" class="form-control"
                                                               name="data[4][button_link]"
                                                               value="{{ old('data.4.button_link', $model->data[4]['button_link']) }}"
                                                               placeholder="Посилання кнопки" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="image-input image-input-outline" id="thumbnailImage1">
                                                    <div class="image-input-wrapper"
                                                         style="background-image: url({{ old('images.1', $model->getImageSrc(1)) }})"></div>

                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="images[1]" accept=".png, .jpg, .jpeg, .webp"/>
                                                    </label>

                                                    <span
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel" data-toggle="tooltip"
                                                        title="Cancel avatar">
		<i class="ki ki-bold-close icon-xs text-muted"></i>
	</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="w-75 my-10">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="data[5][title]"
                                                           value="{{ old('data.5.title', $model->data[5]['title']) }}"
                                                           placeholder="Заголовок" required>
                                                </div>
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control ckeditor"
                                                              name="data[5][body]" placeholder="Вміст"
                                                              required>{!! old('data.5.body', $model->data[5]['body']) !!}</textarea>
                                                </div>
                                            </div>
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
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('js/helpers.js') }} "></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.ckeditor', function (item) {
                let contentEditor = CKEDITOR.replace(item);
            })

            let thumbnailImage = new KTImageInput('thumbnailImage');
            let thumbnailImage1 = new KTImageInput('thumbnailImage1');

            $('.kt-image').each(function (i, item) {
                new KTImageInput(this)
            })

        })
    </script>
@endsection
