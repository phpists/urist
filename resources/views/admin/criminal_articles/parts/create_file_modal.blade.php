<div class="modal fade" id="createFileModal" tabindex="-1" role="dialog" aria-labelledby="createFileTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Створити файл</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="file_form" action="{{ route('files.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="storeFileArticleId" name="criminal_article_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="storeFileName">Назва</label>
                                <input class="form-control" id="storeFavName" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="storeFileFolder">Виберіть папку</label>
                                <div>
                                    <select name="folder_id" class="form-control" id="storeFileFolder">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary">Додати</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
