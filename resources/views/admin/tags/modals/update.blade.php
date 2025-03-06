<!-- Modal -->
<div class="modal fade" id="updateArticleCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFaqTitle">Редагувати тег</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.tag.update') }}" method="POST">
                @csrf
                @method('put')

                <input type="hidden" id="updateTagId" name="id">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateTagName" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateTagName" name="name" required>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="updateTagColor" class="col-auto col-form-label font-weight-bold">Колір</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <input id="updateTagPrimaryColor" class="form-control" type="color" name="primary_color" value="#ffffff">
                                        <input id="updateTagSecondaryColor" class="form-control" type="color" name="secondary_color" value="#ffffff">
                                    </div>
                                    <span class="form-text text-muted">Вкажіть другий як 255,255,255 щоб застосувати тільки перший як однотонний</span>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="updateTagBorderColor" class="col-auto col-form-label font-weight-bold">Колір рамки (border)</label>
                                <div class="col-sm-12">
                                    <input id="updateTagBorderColor" class="form-control" type="color" name="border_color" value="#ffffff">
                                </div>
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
