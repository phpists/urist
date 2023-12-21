@extends('admin.layouts.app')

@section('title', 'Закладки')

@section('styles')
    <style>
        a.non-draggable {
            -webkit-user-drag: none;
            user-select: none;
        }
        .folder_container {
            min-height: 256px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-grow-1">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title col-md-3">Закладки</div>
                    <div class="card-toolbar flex-grow-1">
                        <div class="form-group mb-0 mr-2 flex-grow-1">
                            <select class="form-control" id="searchFile" name="">

                            </select>
                        </div>
                        <a class="btn btn-success font-weight-bolder"
                           data-toggle="modal"
                           data-target="#createFolderModal">
                            <span class="svg-icon svg-icon-md"><i class="fas fa-plus mr-2"></i></span>Створити папку
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($fav_folder))
                    <div data-zone="folder_{{$fav_folder->parent_id}}" data-label="folder_{{$fav_folder->parent_id}}"
                         class="folder_container col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                </h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <a href="{{route('admin.favourites.view', $fav_folder->parent_id)}}"
                                       class="non-draggable d-block text-center">
                                        <img class="max-h-65px h-65px" alt="" src="{{asset('super_admin/media/svg/icons/Text/Dots.svg')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($folders as $folder)
                    <div data-zone="folder_{{$folder->id}}" data-label="folder_{{$folder->id}}"
                         class="folder_container col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                </h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item text-center">
                                                    <a href="#" class="navi-link">
                                                        Редагувати
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <form action="{{route('folders.delete')}}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="folder_id" value="{{$folder->id}}">
                                                        <button class="btn btn-clean w-100 rounded-0 navi-link">
                                                            Видалити
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <a href="{{route('admin.favourites.view', $folder->id)}}" class="d-block text-center">
                                        <img draggable="true"
                                             data-item="folder_{{$folder->id}}"
                                             class="drag_element max-h-65px h-65px non-" src="{{asset('super_admin/media/svg/icons/Files/Folder.svg')}}" alt="">
                                    </a>
                                    <a class="text-dark-75 text-center font-weight-bold mt-15 font-size-lg" href="">{{$folder->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($favourites as $favourite)
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" data-label="file_{{$favourite->id}}">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                </h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item text-center">
                                                    <a href="#" class="navi-link">
                                                        Редагувати
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <form action="{{route('favourites.delete')}}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="favourite_id" value="{{$favourite->id}}">
                                                        <button class="btn btn-clean w-100 rounded-0 navi-link">
                                                            Видалити
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <img draggable="true" data-item="file_{{$favourite->id}}"
                                         class="max-h-65px drag_element" src="{{asset('super_admin/media/svg/files/doc.svg')}}" alt="">
                                    <a class="text-dark-75 text-center font-weight-bold mt-15 font-size-lg" href="">{{$favourite->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('admin.favourites.modals.create_folder')
    @include('admin.file_manager.modals.edit_folder')
    @include('admin.favourites.modals.edit_file_modal')
@endsection

@section('js_after')
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function handleDragEnter(ev) {
            ev.preventDefault()
        }
        function handleDragOver(ev) {
            ev.preventDefault();
        }

        function moveItem(url, folder_id, id) {
            $.ajax({
                url: url,
                method: 'put',
                data: {
                    item_id: id,
                    folder_id: folder_id
                },
                success: function (resp) {
                    console.log(resp)
                }
            })
        }

        function moveFavourite(folder_id, id) {
            moveItem('/favourites/move', folder_id, id);
        }

        function moveFolder(folder_id, id) {
            moveItem('/folder/move', folder_id, id);
        }

        function handleDrop(ev) {
            let item_id = ev.dataTransfer.getData('text/plain');
            if(item_id !== null && ev.currentTarget.dataset.zone !==  item_id) {
                let id = item_id.split('_');
                if(id.length > 1) {
                    if (id[0] === 'file') {
                        let folder_id = ev.currentTarget.dataset.zone.split('_')[1];
                        moveFavourite(folder_id, id[1]);
                    }
                    else if(id[0] === 'folder') {
                        let folder_id = ev.currentTarget.dataset.zone.split('_')[1];
                        moveFolder(folder_id, id[1]);
                    }
                }
                document.querySelector(`*[data-label="${item_id}"]`).remove()
            }
        }
        function handleDragStart(ev) {
            ev.dataTransfer.setData("text/plain", ev.currentTarget.dataset.item);
        }
        document.addEventListener('DOMContentLoaded', function (ev) {
            document.querySelectorAll('.drag_element').forEach((el) => {
                el.addEventListener('dragstart', handleDragStart);
            })
            document.querySelectorAll('.folder_container').forEach((el) => {
                el.addEventListener('dragenter', handleDragEnter)
                el.addEventListener('dragover', handleDragOver)
                el.addEventListener('drop', handleDrop)
            })
            $("#searchFile").select2({
                placeholder: "Назва закладки",
                ajax: makeSelect2AjaxSearch('/favourites/search', 'searchFile')
            })
            $("#searchFile").on('select2:select', function(e) {
                location.href = '/admin/file/' + e.target.value;
            })
        })
    </script>
@endsection
