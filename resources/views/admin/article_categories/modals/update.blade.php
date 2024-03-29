<!-- Modal -->
<div class="modal fade" id="updateArticleCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFaqTitle">Редагувати категорію</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.article_category.update') }}" method="POST">
                @csrf
                @method('put')

                <input type="hidden" id="updateCategoryId" name="id">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateCategoryName" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateCategoryName" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateCategorySubTitle" class="col-auto col-form-label font-weight-bold">Статті</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateCategorySubTitle" name="sub_title">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateCategoryParent" class="col-auto col-form-label font-weight-bold">Батьківська категорія</label>
                                <div class="col-sm-12">
                                    <select name="parent_id" id="updateCategoryParent">
                                    </select>
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
