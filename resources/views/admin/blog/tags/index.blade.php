@extends('admin.layouts.app')
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
                        <a href="{{ route('admin.blog.index') }}" class="text-muted">Блог</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Хештеги</span>
                    </li>
                </ul>
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
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Хештеги</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2 mb-0" id="customBulkRecordsDeleteForm" action="{{ route('admin.blog-tags.bulk-delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Ви дійсно хочете видалити записи?')"
                                        class="btn btn-danger font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-trash mr-2"></i></span> Видалити
                                </button>
                            </form>
                            <button type="button" data-toggle="modal" data-target="#createBlogTagModal"
                               class="btn btn-success font-weight-bolder">
                                <span class="svg-icon svg-icon-md"><i class="fas fa-plus mr-2"></i></span>Створити
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive" id="table_container">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
                                </th>
                                <th class="pr-0 text-center">
                                    #
                                </th>
                                <th class="pr-0 text-center">
                                    Назва
                                </th>
                                <th class="pr-0 text-center">
                                    Дії
                                </th>
                            </tr>
                            </thead>
                            <tbody id="blog_table" class="blog_table" data-update-positions-url="{{ route('admin.blog-tags.sort') }}">
                            @foreach($blogTags as $item)
                                <tr class="handle table-sortable-drag" data-id="{{ $item->id }}">
                                    <td class="text-center pl-0">
                <span style="width: 20px;">
                    <label class="checkbox checkbox-single">
                        <input class="checkbox-item" type="checkbox" name="ids[]"
                               value="{{ $item->id }}">&nbsp;<span></span>
                    </label>
                </span>
                                    </td>
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        <i class="flaticon2-sort"></i>
                                    </td>
                                    <td class="pr-0 text-center">
                                        {{ $item->title }}
                                    </td>
                                    <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                                        <button type="button" data-toggle="modal" data-target="#editBlogTagModal"
                                                data-show-url="{{ route('admin.blog-tags.show', $item) }}"
                                                data-update-url="{{ route('admin.blog-tags.update', $item) }}"
                                           class="btn btn-sm btn-clean btn-icon edit-btn">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.blog-tags.destroy', $item) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button
                                                class="btn btn-sm btn-clean btn-icon"
                                                onclick="return confirm('Ви впевнені, що хочете видалити запис?')">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@include('admin.blog.tags.modals.create')
@include('admin.blog.tags.modals.edit')

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('super_admin/js/blog-tags.js') }}"></script>
@endsection
