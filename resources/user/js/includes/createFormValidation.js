import JustValidate from 'just-validate';

const createFormValidation = () => {
    if (document.getElementById('create-form')) {
        const validator = new JustValidate('#create-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputCreateFolderTitle') &&
            validator.addField('#inputCreateFolderTitle', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        validator.onSuccess((event) => {
            let form = event.currentTarget;

            $.ajax({
                type: form.method,
                url: form.action,
                data: $(form).serialize(),
                dataType: 'json',
                success: function (response) {
                    throwSuccessToaster(response.message);
                },
                error: function (jqXHR) {
                    throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
                },
                complete: function () {
                    $('#modal-create button.modal__close').click()
                    updateContainer('#itemsContainer', location.href)
                }
            })
        });
    }
}

export default createFormValidation;
