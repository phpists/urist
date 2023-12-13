@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('js/jstree/dist/themes/default/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('super_admin/css/category.css')}}" />
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
                <div class="card-header">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#table_tab">
                                    <span class="nav-text">Створити</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tree_tab">
                                    <span class="nav-text">Дерево</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <div class="col-auto">
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
                        <div class="tab-pane fade show" role="tabpanel" id="tree_tab">
                            <div id="jstree_container">
                                <ul>
                                    @foreach($tree_categories as $article_category)
                                        <li id="node_{{$article_category->id}}">{{$article_category->name}}
                                            @if(sizeof($article_category->children) > 0)
                                                <ul>
                                                    @foreach($article_category->children as $article_subcategory)
                                                        <li id="node_{{$article_subcategory->id}}">{{$article_subcategory->name}}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>

                                    @endforeach
                                </ul>
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
    <script src="{{asset('js/jstree/dist/jstree.min.js')}}"></script>
    <script>
        function makeAjaxCategorySearch() {
            return {
                url: '/admin/article_category/search',
                data: function (params) {
                    var query = {
                        search_string: params.term,
                        exclude_id: document.getElementById('updateCategoryId').value
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    data = data.map((el) => {
                        return {
                            id: el.id,
                            text: el.name
                        }
                    })
                    return {
                        results: data
                    };
                }
            }
        }
        function changeParent(category_id, parent_id) {
            $.ajax({
                url: '/admin/article_category/update_parent',
                method: 'put',
                data: {
                    id: category_id,
                    parent_id: parent_id
                },
                error: function (resp) {
                    console.log(resp)
                }
            })
        }
        document.addEventListener('DOMContentLoaded', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#createCategoryParent").select2({
                placeholder: "Виберіть батьківську категорію",
                ajax: makeAjaxCategorySearch()
            });
            $("#updateCategoryParent").select2({
                placeholder: "Виберіть батьківську категорію",
                ajax: makeAjaxCategorySearch()
            })
            $('.updateArticleCategory').on('click', function (ev) {
                let categoryId = ev.currentTarget.dataset.id;
                $.ajax({
                    url: '{{route('admin.article_categories.view')}}',
                    data: {
                        id: categoryId
                    },
                    success: function (resp) {
                        document.getElementById('updateCategoryId').value = categoryId;
                        $("#updateCategoryName").val(resp.name)
                        if (resp.parent_category !== null) {
                            let categorySelect = $("#updateCategoryParent");
                            let option = document.createElement('option');
                            option.value = resp.parent_category.id;
                            option.innerText = resp.parent_category.name;
                            categorySelect.append(option);
                            option.selected = 'selected';
                        }
                    }
                })
            })

            $('#jstree_container').jstree({
                core: {
                    'check_callback': true
                },
                "plugins" : [ "dnd" ]
            });
            let jstreeEl = $('#jstree_container');
            jstreeEl.on('open_node.jstree', function (ev, node) {
                if(node.node.children.length === 0 || (node.node.children.length < node.node.children_d.length)) {
                    return;
                }
                let el_ids = node.node.children.map((el) => {
                    return el.split('_')[1];
                })
                $.ajax({
                    url: "/admin/article_category/get_children",
                    data: {
                        id_list: el_ids
                    },
                    success: function (resp) {
                        resp.forEach((el) => {
                            jstreeEl.jstree('create_node', $('#node_' + el.parent_id), {
                                "id": "node_" + el.id,
                                "text": el.name
                            }, 'last', false, false)
                        })
                    }
                })
            });
            jstreeEl.on('activate_node.jstree', function (ev, node) {
                if (!node.node.state.opened) {
                    jstreeEl.jstree('open_node', $('#' + node.node.id));
                }
                else {
                    jstreeEl.jstree('close_node', $('#' + node.node.id));
                }
            });
            jstreeEl.on('move_node.jstree', function (ev, node) {
                let parent_id = node.parent.split('_');
                if(parent_id.length > 1) {
                    parent_id = parent_id[1]
                }
                else {
                    parent_id = null;
                }
                changeParent(node.node.id.split('_')[1], parent_id)
            })
        })
    </script>
@endsection

