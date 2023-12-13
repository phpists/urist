<div class="modal fade" id="createFavouriteModal" tabindex="-1" role="dialog" aria-labelledby="createFavouriteTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Добавить категорию статьи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_favourites_form" action="{{ route('criminal_articles.favourites.add') }}" method="POST">
                    @csrf
                    <input type="hidden" id="storeFavArticleId" name="criminal_article_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="storeFavName">Назва</label>
                                <input class="form-control" id="storeFavName" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="storeFavFolder">Виберіть папку</label>
                                <div>
                                    <select name="folder_id" class="form-control" id="storeFavFolder">

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
