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
                        <span class="text-muted">Сповіщення</span>
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
                        <h3 class="card-label">Сповіщення</h3>
                    </div>

                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline d-flex mr-2">
                            <button data-toggle="modal" data-target="#createNotificationModal"
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
                                <th class="pr-0 text-center">
                                    Заголовок
                                </th>
                                <th class="pr-0 text-center">
                                    Посилання
                                </th>
                                <th class="pr-0 text-center">
                                    Час
                                </th>
                                <th class="pr-0 text-center">
                                    Дії
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $item)
                                <tr>
                                    <td class="pr-0 text-center">
                                        {{ $item->title }}
                                    </td>
                                    <td class="pr-0 text-center">
                                        <a href="{{ $item->url }}">{{ $item->url }}</a>
                                    </td>
                                    <td class="pr-0 text-center">
                                        {{ $item->pretty_created_at }}
                                    </td>
                                    <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                                        <form action="{{ route('admin.notifications.destroy', $item->id) }}" method="POST">
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
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@include('admin.notifications.modals.create')

@section('js_after')
@endsection
