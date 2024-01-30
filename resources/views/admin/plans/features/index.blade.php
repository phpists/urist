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
                        <a href="{{ route('admin.plans.index') }}" class="text-muted">Тарифні плани</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Можливості тарифних планів</span>
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
                        <h3 class="card-label">Можливості тарифних планів</h3>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive" id="table_container">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pr-0 text-center">
                                    #
                                </th>
                                <th class="pr-0 text-center">
                                    Доступний
                                </th>
                                <th class="pr-0 text-center">
                                    Назва
                                </th>
                                <th class="pr-0 text-center">
                                    Дії
                                </th>
                            </tr>
                            </thead>
                            <tbody id="blog_table" class="blog_table" data-update-positions-url="{{ route('admin.features.sort') }}">
                            @foreach($features as $item)
                                <tr class="handle table-sortable-drag" data-id="{{ $item->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        <i class="flaticon2-sort"></i>
                                    </td>
                                    <td class="pr-0 text-center">
                    <span class="switch justify-content-center">
                                    <label>
                                        <input class="bool-updatable" type="checkbox" @checked($item->is_active) name="is_active" data-url="{{ route('admin.features.update', $item) }}">
                                        <span></span>
                                    </label>
                                </span>
                                    </td>
                                    <td class="pr-0">
                                        {{ $item->title }}
                                    </td>
                                    <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                                        <button type="button" data-toggle="modal" data-target="#editFeatureModal"
                                                data-show-url="{{ route('admin.features.show', $item) }}"
                                                data-update-url="{{ route('admin.features.update', $item) }}"
                                           class="btn btn-sm btn-clean btn-icon edit-btn">
                                            <i class="las la-edit"></i>
                                        </button>
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

@include('admin.plans.features.modals.edit')

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('super_admin/js/features.js') }}"></script>
@endsection
