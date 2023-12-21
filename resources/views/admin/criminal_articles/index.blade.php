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
                        <a href="{{ route('admin.criminal_articles.index') }}" class="text-muted">Кримінальні статті</a>
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
                        <h3 class="card-label">Статті</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2" id="bulkRecordsDeleteForm" action="{{route('admin.criminal_articles.bulk_delete')}}">
                                <button onclick="confirm('Ви дійсно хочете видалити записи?')"
                                        class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-trash mr-2"></i></span> Видалити
                                </button>
                            </form>
                            <a href="{{ route('admin.criminal_articles.create') }}"
                               class="btn btn-success font-weight-bolder">
                                <span class="svg-icon svg-icon-md"><i class="fas fa-plus mr-2"></i></span>Створити
                            </a>
                        </div>
                    </div>
                    <div class="card-toolbar w-100">
                        <form id="filterDataForm" class="w-100" action="{{ route('admin.criminal_articles.index') }}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <select multiple="multiple" class="form-control" name="article_category_list[]" id="category_select"></select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input placeholder="Пошук по назві" class="form-control" type="text" name="name" id="nameSearch">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive" id="table_container">
                        @include('admin.criminal_articles.parts.table', compact('criminal_articles'))
                    </div>
                    <div id="pagination_container">
                        @include('admin.criminal_articles.parts.paginate', compact('criminal_articles'))
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    @include('admin.criminal_articles.parts.add_to_fav_modal')
    @include('admin.criminal_articles.parts.create_file_modal')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('super_admin/js/criminal_articles.js') }}"></script>
@endsection
