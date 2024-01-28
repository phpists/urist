<!-- Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="editPlanModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlanModalLabel">Редагувати план</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editPlanForm" action="{{ route('admin.plans.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="editPlanTitle" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editPlanTitle" name="title" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 px-0">
                            <div class="form-group">
                                <label for="editPlanIsActive" class="col-auto col-form-label font-weight-bold">Доступний</label>
                                <span class="switch justify-content-center">
								<label>
									<input id="editPlanIsActive" class="bool-updatable" type="checkbox" name="is_active">
									<span></span>
								</label>
							</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 px-0">
                            <div class="form-group w-100">
                                <label for="editPlanPriceMonthly" class="col-auto col-form-label font-weight-bold">В місяць</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editPlanPriceMonthly" name="price_monthly">
                                </div>
                            </div>
                        </div>
                        <div class="col-4 px-0">
                            <div class="form-group w-100">
                                <label for="editPlanPriceSemiannual" class="col-auto col-form-label font-weight-bold">В пів року</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editPlanPriceSemiannual" name="price_semiannual">
                                </div>
                            </div>
                        </div>
                        <div class="col-4 px-0">
                            <div class="form-group w-100">
                                <label for="editPlanPriceAnnual" class="col-auto col-form-label font-weight-bold">В рік</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editPlanPriceAnnual" name="price_annual">
                                </div>
                            </div>
                        </div>
                    </div>



                        @foreach($features as $feature)
                        <hr>
                        <div class="row">
                            <div class="col-auto">
                                <span class="switch switch-sm switch-icon">
								<label>
									<input class="feature" id="feature-{{ $feature->id }}" type="checkbox" name="features[]" value="{{ $feature->id }}">
									<span></span>
								</label>
							</span>
                            </div>
                            <div class="col">
                                <label for="feature-{{ $feature->id }}" class="col-form-label py-0 my-auto">{{ $feature->title }}</label>
                            </div>
                        </div>
                        @endforeach


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
