<!-- Modal -->
<div class="modal fade" id="cloneCategoryModal" tabindex="-1" role="dialog" aria-labelledby="cloneCategoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cloneCategoryModalLabel">Клонувати статтю</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="cloneCategoryForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="cloneParentCategoryId" class="col-auto col-form-label font-weight-bold">Батьківська категорія</label>
                                <div class="col-sm-12">
                                    @php($category = null)
                                    <select class="form-control select2" name="parent_category_id" id="cloneParentCategoryId" style="width: 100%;" required>
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
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Клонувати</button>
                </div>

            </form>

        </div>
    </div>
</div>
