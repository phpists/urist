@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('js/jstree/dist/themes/default/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('super_admin/css/category.css')}}" />
    <link rel="stylesheet" href="{{asset('super_admin/css/nestable.min.css')}}"></link>
@endsection

@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Категорії статей</h5>
@endsection
@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#table_tab">
                                    <span class="nav-text">Створити</span>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-toggle="tab" href="#tree_tab">--}}
{{--                                    <span class="nav-text">Дерево</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tree_nested_tab">
                                    <span class="nav-text">Дерево</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2" id="bulkRecordsDeleteForm" action="{{route('admin.article_categories.bulk_delete')}}">
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
                                @include('admin.article_categories._table')
                            </div>
                        </div>
{{--                        <div class="tab-pane fade show" role="tabpanel" id="tree_tab">--}}
{{--                            <div id="jstree_container">--}}
{{--                                <ul>--}}
{{--                                    @foreach($tree_categories as $article_category)--}}
{{--                                        <li id="node_{{$article_category->id}}">{{$article_category->name}}--}}
{{--                                            @if(sizeof($article_category->children) > 0)--}}
{{--                                                <ul>--}}
{{--                                                    @foreach($article_category->children as $article_subcategory)--}}
{{--                                                        <li id="node_{{$article_subcategory->id}}">{{$article_subcategory->name}}</li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            @endif--}}
{{--                                        </li>--}}

{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-pane fade" role="tabpanel" id="tree_nested_tab">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="dd w-100" id="nestable3">
                                                <ol class="dd-list">
                                                    @include('admin.article_categories.parts.table', ['categories' => $tree_categories])

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    @include('admin.article_categories.modals.create')
    @include('admin.article_categories.modals.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{asset('js/jstree/dist/jstree.min.js')}}"></script>
    <script src="{{asset('super_admin/js/jquery.nestable.min.js')}}"></script>
    <script src="{{asset('super_admin/js/category.js')}}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>

    </script>
@endsection

