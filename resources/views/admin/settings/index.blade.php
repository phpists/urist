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
                        <span class="text-muted">Загальні налаштування</span>
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
                        <h3 class="card-label">Загальні налаштування</h3>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive" id="table_container">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pr-0 text-center">
                                    Опція
                                </th>
                                <th class="pr-0 text-center">
                                    Значення
                                </th>
                                <th class="pr-0 text-center">
                                    Дії
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $item)
                                <tr>
                                    <td class="pr-0 text-center">
                                        {{ $item->title }}
                                    </td>
                                    <td class="pr-0 text-center">
                                        {{ $item->value }}
                                    </td>
                                    <td class="pr-0 text-center">
                                        <button type="button" class="btn btn-sm btn-clean btn-icon edit-btn"
                                           data-show-url="{{ route('admin.settings.show', $item) }}"
                                           data-update-url="{{ route('admin.settings.update', $item) }}"
                                           data-toggle="modal" data-target="#editSettingModal"
                                           data-id="{{ $item->id }}">
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

@include('admin.settings.modals.edit')

@section('js_after')
    <script>
        jQuery(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click', 'button.edit-btn', function (e) {
                let $btn = $(this),
                    showUrl = $btn.data('show-url'),
                    updateUrl = $btn.data('update-url');

                $.ajax({
                    url: showUrl,
                    dataType: 'json',
                    success: function (response) {
                        if (response.id) {
                            $('#editSettingForm')
                                .attr('action', updateUrl)
                                .find('[name="value"]').val(response.value);
                        }
                    }
                })
            })

        });
    </script>
@endsection
