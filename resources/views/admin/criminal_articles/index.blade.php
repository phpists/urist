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
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
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
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="{{ route('admin.criminal_articles.create') }}"
                                   class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-plus mr-2"></i></span>Створити
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            @include('admin.criminal_articles.parts.table', compact('criminal_articles'))
                        </div>
                        <div id="pagination">
                            {{ $criminal_articles->appends(request()->all())->links('vendor.pagination.product_pagination') }}
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Container-->
        <!--end::Entry-->

    </div>
    @include('admin.criminal_articles.parts.add_to_fav_modal')
    @include('admin.criminal_articles.parts.create_file_modal')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>

        jQuery(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            document.querySelectorAll('.favouriteBtn').forEach((el) => {
                el.addEventListener('click', function () {
                    document.getElementById('storeFavArticleId').value = el.dataset.id;
                })
            });
            document.querySelectorAll('.fileBtn').forEach((el) => {
                el.addEventListener('click', function () {
                    document.getElementById('storeFileArticleId').value = el.dataset.id;
                })
            });
            // document.getElementById('add_favourites_form').addEventListener('submit', (ev) => {
            //     ev.preventDefault();
            //     let criminal_article_id = document.getElementById('storeFavArticleId').value;
            //     $.ajax({
            //         url: ev.currentTarget.action,
            //         method: 'POST',
            //         data: {
            //             criminal_article_id: criminal_article_id,
            //             name: document.getElementById('storeFavName').value,
            //             folder_id: document.getElementById('storeFavFolder')?.value??null
            //         },
            //         success: () => {
            //             let callBtn = document.getElementById('row_' + criminal_article_id);
            //             if (callBtn.classList.contains('active')) {
            //                 callBtn.innerHTML = '<i class="far fa-star"></i>';
            //             }
            //             else {
            //                 callBtn.innerHTML = '<i class="fas fa-star"></i>';
            //             }
            //             callBtn.classList.toggle('active');
            //             const myModal = new bootstrap.Modal('#createFavouriteModal', {
            //                 keyboard: false
            //             });
            //             myModal.hide();
            //         }
            //     })
            // })
            $("#storeFavFolder").select2({
                placeholder: "Назва папки",
                ajax: makeSelect2AjaxSearch('/folders/search_favourites', 'storeFavFolder')
            })
            $("#storeFileFolder").select2({
                placeholder: "Назва папки",
                ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'storeFileFolder')
            })
        });
    </script>
@endsection
