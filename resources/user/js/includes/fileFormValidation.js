import JustValidate from 'just-validate';

const fileFormValidation = () => {
    if (document.getElementById('file-form')) {
        const validator = new JustValidate('#file-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputFileTitle') &&
            validator.addField('#inputFileTitle', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.querySelector('[name="criminal_article_id"]') &&
            validator.addField('[name="criminal_article_id"]', [
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
                    $('#modal-file button.modal__close').click()
                }
            })
        });
    }
}

export default fileFormValidation;
