<!-- Modal -->
<div class="modal fade" id="createNotificationModal" tabindex="-1" role="dialog" aria-labelledby="createNotificationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNotificationModalLabel">Створити сповіщення</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createNotificationForm" action="{{ route('admin.notifications.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="createNotificationTitle" class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createNotificationTitle" name="title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group w-100">
                                <label for="createNotificationUrl" class="col-auto col-form-label font-weight-bold">Посилання</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createNotificationUrl" name="url">
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
