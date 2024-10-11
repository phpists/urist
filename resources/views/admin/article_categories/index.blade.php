@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('js/jstree/dist/themes/default/style.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('super_admin/css/category.css')}}"/>
    <link rel="stylesheet" href="{{asset('super_admin/css/nestable.min.css')}}">
    <style>
        a.non-draggable, svg.non-draggable, img.non-draggable {
            -webkit-user-drag: none;
            user-select: none;
        }

        .select2-container {
            width: 100%;
        }
    </style>
@endsection

@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Категорії статей</h5>
@endsection
@section('content')
    <style>
        .dd {
            max-width: none !important;
        }
    </style>

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
                                <a class="nav-link @if(!$tab || $tab == 'table') active @endif"
                                   href="{{ route('admin.article_categories', ['tab' => 'table']) }}">
                                    <span class="nav-text">Список</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($tab == 'tree_nested_tab') active @endif"
                                   href="{{ route('admin.article_categories', ['tab' => 'tree_nested_tab']) }}">
                                    <span class="nav-text">Дерево</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2" id="bulkRecordsDeleteForm"
                                  action="{{route('admin.article_categories.bulk_delete')}}">
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
                        @if(!$tab || $tab == 'table')
                            <div class="tab-pane fade show active" role="tabpanel" id="table_tab">

                                <div class="card-toolbar w-100">
                                    <form id="filterDataForm" class="w-100" action="">
                                        <input type="hidden" name="per-page">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input placeholder="Пошук по назві" class="form-control" type="text"
                                                           name="search" id="nameSearch">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="table_data">
                                    @include('admin.article_categories._table')
                                </div>
                            </div>
                        @elseif($tab == 'tree_nested_tab')
                            <div class="tab-pane fade show active" role="tabpanel" id="tree_nested_tab">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach(\App\Enums\CriminalArticleTypeEnum::cases() as $case)
                                                    <a class="btn @if($category?->type == $case->value) btn-primary @else btn-outline-primary @endif" href="{{ route('admin.article_categories', ['tab' => 'tree_nested_tab', 'category' => $caseCategory = $case->getCategory()]) }}">{{ $caseCategory->name }}</a>
                                                @endforeach
                                            </div>
                                            @isset($category)
                                                <div class="col-12">
                                                    <hr class="my-2">
                                                    @foreach($category->children as $categoryChildCategory)
                                                        <a class="btn mb-1 @if($childCategory?->id == $categoryChildCategory->id) btn-primary @else btn-outline-primary @endif" href="{{ route('admin.article_categories', ['tab' => 'tree_nested_tab', 'category' => \App\Enums\CriminalArticleTypeEnum::tryFrom($categoryChildCategory->type)->getCategory(), 'childCategory' => $categoryChildCategory]) }}">{{ $categoryChildCategory->name }}</a>
                                                    @endforeach
                                                </div>
                                            @endisset
                                        </div>

                                        <hr class="my-3">

                                        <div class="row">
                                            <div class="col-12">
                                                @if($childCategory)
                                                <div class="dd w-100" id="nestable3" data-update-url="{{ route('admin.article_category.update_position', $childCategory) }}">
                                                    <ol class="dd-list" data-id="{{ $childCategory->id }}">
                                                        @include('admin.article_categories.parts.table', ['categories' => $childCategory->children])
                                                    </ol>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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

    @include('admin.layouts.modals.show_category_full_path')
    @include('admin.article_categories.modals.add-article')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="{{asset('js/jstree/dist/jstree.min.js')}}"></script>
    <script src="{{asset('super_admin/js/jquery.nestable.min.js')}}"></script>
    <script src="{{asset('super_admin/js/category.js')}}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>


    <script>
        $(function () {
            initDragAndDrop()

            $(document).on('ajaxComplete', initDragAndDrop);

            $(document).on('click', '.delete-article-category', function (e) {
                if (!confirm('Ви впевнені, що хочете видалити статтю з категорії?'))
                    return;

                const el = this;

                $.ajax({
                    type: 'POST',
                    url: this.dataset.url,
                    data: {
                        category_id: this.dataset.categoryId,
                    },
                    success: function (response) {
                        if (response.result)
                            $(el).parent().remove()
                    }
                })
            })

            $(document).on('click', '.add-article-btn', function (e) {
                let categoryId = this.dataset.id;
                $('#addCriminalArticleModal form input[name="category_id"]').val(categoryId)
            })

            $("#addCriminalArticleId").select2({
                placeholder: "Стаття",
                minimumInputLength: 3,
                ajax: makeSelect2AjaxSearch('{{ route('admin.criminal-articles.data-for-select') }}', 'addCriminalArticleId')
            })

            $(document).on('submit', '#addCriminalArticleModal form', function (e) {
                e.preventDefault();
                let category_id = $('#addCriminalArticleModal form input[name="category_id"]').val()

                $.ajax({
                    type: this.method,
                    url: this.action,
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log(category_id, $(`.droppable[data-id="${category_id}"]`), response.html[category_id])
                        $(`.droppable[data-id="${category_id}"]`).html(response.html[category_id]);
                        $('#addCriminalArticleModal').modal('hide');
                    }
                })
            })
        })

        function initDragAndDrop() {
            $('.drag-element').draggable({
                scroll: true,
                revert: function ($droppable) {
                    if (!$droppable)
                        return true;

                    return this.data('category-id') === $droppable.data('id');
                },
                handle: '.handle',
                start: function () {
                    console.log('start')
                    this.style.zIndex = 9
                },
                stop: function () {
                    console.log('stop')
                    this.style.zIndex = 'inherit'
                }
            });

            $('.droppable').droppable({
                accept: '.drag-element',
                drop: function (e, ui) {
                    console.log('drop')
                    if (ui.draggable.length) {
                        let draggable = ui.draggable[0],
                            old_category_id = draggable.dataset.categoryId,
                            category_id = this.dataset.id;

                        if (old_category_id !== category_id) {
                            $.ajax({
                                // async: false,
                                type: 'POST',
                                url: draggable.dataset.url,
                                data: {
                                    old_category_id: old_category_id,
                                    category_id: category_id,
                                },
                                success: function (response) {
                                    document.querySelector(`.droppable[data-id="${old_category_id}"]`).innerHTML = response.html[old_category_id];
                                    document.querySelector(`.droppable[data-id="${category_id}"]`).innerHTML = response.html[category_id];
                                    draggable.remove()
                                }
                            })
                        }
                    }
                }
            });
        }


    </script>
@endsection

