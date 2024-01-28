<!-- Modal -->
<div class="modal fade" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="editFeatureModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFeatureModalLabel">Редагувати план</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editFeatureForm" action="{{ route('admin.plans.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="editFeatureTitle" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editFeatureTitle" name="title" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 px-0">
                            <div class="form-group">
                                <label for="editFeatureIsActive" class="col-auto col-form-label font-weight-bold">Доступний</label>
                                <span class="switch justify-content-center">
								<label>
									<input id="editFeatureIsActive" class="bool-updatable" type="checkbox" name="is_active">
									<span></span>
								</label>
							</span>
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
