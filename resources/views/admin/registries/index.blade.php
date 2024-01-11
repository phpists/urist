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
                        <a href="#" class="text-muted">Реєстр</a>
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
                        <h3 class="card-label">Реєстр</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <form class="mr-2" id="bulkRecordsDeleteForm" action="{{route('admin.registries.bulk_delete')}}">
                                <button onclick="confirm('Ви дійсно хочете видалити записи?')"
                                        class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-trash mr-2"></i></span> Видалити
                                </button>
                            </form>
                            <button type="button" data-toggle="modal" data-target="#createRegistryModal"
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
                                    ID
                                </th>
                                <th class="pr-0 text-center">
                                    Назва
                                </th>
                                <th class="pr-0 text-center">
                                    Посилання
                                </th>
                                <th class="pr-0 text-center">
                                    Дії
                                </th>
                            </tr>
                            </thead>
                            <tbody class="">
                            @foreach($registries as $item)
                                <tr>
                                    <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $item->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                                    </td>
                                    <td class="text-center pl-0">
                                        {{ $item->id }}
                                    </td>
                                    <td class="pr-0 text-center">
                                        {{ $item->title }}
                                    </td>
                                    <td class="pr-0 text-center">
                                        <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                                    </td>
                                    <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                                        <button type="button" data-show-url="{{ route('admin.registries.show', $item) }}"
                                                data-update-url="{{ route('admin.registries.update', $item) }}" data-toggle="modal"
                                                data-target="#editRegistryModal"
                                           class="btn btn-sm btn-clean btn-icon edit-btn">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.registries.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                class="btn btn-sm btn-clean btn-icon"
                                                onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div id="pagination_container">
                        {{ $registries->links('vendor.pagination.product_pagination') }}
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

    @include('admin.registries.modals.create')
    @include('admin.registries.modals.edit')
@endsection

@section('js_after')
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.edit-btn', function (e) {
                $('#editRegistryForm').attr('action', $(this).data('update-url'));

                $.ajax({
                    url: $(this).data('show-url'),
                    dataType: 'json',
                    success: function (response) {
                        for (let field in response) {
                            let $input = $(`#editRegistryForm [name="${field}"]`);
                            if ($input.length > 0) {
                                $input.val(response[field])
                            }
                        }
                    }
                })
            })

        })
    </script>
@endsection
