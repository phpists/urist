<!-- Modal -->
<div class="modal fade" id="createArticleCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Додати хештег</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
            </div>

            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="createCategoryName" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createCategoryName" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <label for="createTagColor" class="col-auto col-form-label font-weight-bold">Колір</label>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input id="createTagPrimaryColor" class="form-control" type="color" name="primary_color" value="#ffffff">
                                <input id="createTagSecondaryColor" class="form-control" type="color" name="secondary_color" value="#ffffff">
                            </div>
                            <span class="form-text text-muted">Вкажіть другий як 255,255,255 щоб застосувати тільки перший як однотонний</span>
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <label for="createTagBorderColor" class="col-auto col-form-label font-weight-bold">Колір рамки (border)</label>
                        <div class="col-sm-12">
                            <input id="createTagBorderColor" class="form-control" type="color" name="border_color" value="#ffffff">
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
