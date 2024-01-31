import JustValidate from 'just-validate';

const bookmarkFormValidation = () => {
    if (document.getElementById('bookmark-form')) {

        const validator = new JustValidate('#bookmark-form', {
            errorLabelCssClass: ['error-label'],
        });

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
                    $('#modal-bookmark button.modal__close').click()
                }
            })
        });
    }
}

export default bookmarkFormValidation;
