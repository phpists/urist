@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('js/jstree/dist/themes/default/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('super_admin/css/category.css')}}" />
    <link rel="stylesheet" href="{{asset('super_admin/css/nestable.min.css')}}"></link>
@endsection

@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Хештеги</h5>
@endsection
@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#table_tab">
                                    <span class="nav-text">Створити</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2" id="bulkRecordsDeleteForm" action="{{route('admin.tags.bulk_delete')}}">
                                <button onclick="confirm('Ви дійсно хочете видалити записи?')"
                                        class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-trash mr-2"></i></span> Видалити
                                </button>
                            </form>
                            <button data-toggle="modal" data-target="#createArticleCategoryModal"
                                    class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Додати
                            </button>
                        </div>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body pb-3">
                    @include('admin.layouts.includes.messages')
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" id="table_tab">
                            <div id="table_data">
                                @include('admin.tags._table')
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.tags.modals.create')
    @include('admin.tags.modals.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{asset('super_admin/js/tag.js')}}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>

    </script>
@endsection

