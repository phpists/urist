<!-- Modal -->
<div class="modal fade" id="subscribeUser" tabindex="-1" role="dialog" aria-labelledby="subscribeUserTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscribeUserTitle">Надати підписку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form method="POST">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="subscribeUserPeriod" class="font-weight-bold">Період</label>
                                <select class="form-control" name="period" id="subscribeUserPeriod">
                                    @foreach(['month', 'year'] as $period)
                                        <option value="{{ $period }}">{{ __('subscription.'.$period) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрити
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Надати</button>
                </div>

            </form>

        </div>
    </div>
</div>
