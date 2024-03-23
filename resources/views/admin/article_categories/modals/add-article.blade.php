<!-- Modal -->
<div class="modal fade" id="addCriminalArticleModal" tabindex="-1" role="dialog" aria-labelledby="addCriminalArticleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCriminalArticleModalLabel">Додати статтю</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.criminal-article.add-category') }}" method="POST">
                <input type="hidden" name="category_id">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="addCriminalArticleId" class="col-auto col-form-label font-weight-bold">Стаття</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="article_id" id="addCriminalArticleId" style="width: 100%;">
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
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Додати</button>
                </div>

            </form>

        </div>
    </div>
</div>
