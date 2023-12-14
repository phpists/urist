<!-- Modal -->
<div class="modal fade" id="updateFolderModal" tabindex="-1" role="dialog" aria-labelledby="updateFolderTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Оновити папку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('folder.update') }}" method="POST">
                @method('put')
                @csrf
                <input type="hidden" name="folder_type" value="{{\App\Enums\FolderType::FILE_FOLDER->value}}">
                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                <input type="hidden" id="updateFolderId" name="folder_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateFolderName" class="col-auto col-form-label font-weight-bold">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateFolderName" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="updateParentFolder">Папка</label>
                                <div>
                                    <select class="form-control" name="parent_id" id="updateParentFolder">
                                        @if(isset($file_folder))
                                            <option selected value="{{$file_folder->id}}">{{$file_folder->name}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                </div>

            </form>

        </div>
    </div>
</div>

