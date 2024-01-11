<!-- Modal -->
<div class="modal fade" id="createRegistryModal" tabindex="-1" role="dialog" aria-labelledby="createRegistryModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRegistryModalTitle">Додати реєстр</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.registries.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="createRegistryTitle" class="font-weight-bold">Назва</label>
                                <input id="createRegistryTitle" type="text" name="title" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="createRegistryLink" class="font-weight-bold">Посилання</label>
                                <input id="createRegistryLink" type="text" name="link" class="form-control">
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
