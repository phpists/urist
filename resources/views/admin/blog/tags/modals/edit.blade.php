<!-- Modal -->
<div class="modal fade" id="editBlogTagModal" tabindex="-1" role="dialog" aria-labelledby="editBlogTagModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogTagModalLabel">Редагувати тег</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editBlogTagForm" action="{{ route('admin.blog-tags.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="editBlogTagTitle" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editBlogTagTitle" name="title" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="editBlogTagSlug" class="col-auto col-form-label font-weight-bold">Посилання (slug)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editBlogTagSlug" name="slug">
                                </div>
                                <span class="form-text text-muted">Буде згенеровано автоматично, якщо залишити пустим</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрити
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Зберегти</button>
                </div>

            </form>

        </div>
    </div>
</div>
