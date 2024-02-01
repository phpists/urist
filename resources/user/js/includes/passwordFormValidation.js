import JustValidate from 'just-validate';

const passwordFormValidation = () => {
    if (document.getElementById('edit-password-form')) {
        const validator = new JustValidate('#edit-password-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputEditPassword') &&
            validator.addField('#inputEditPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputEditNewPassword') &&
            validator.addField('#inputEditNewPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'password',
                    errorMessage: "Пароль повинен містити як мінімум 1 цифру і складатись з не менш як 8 символів",
                },
            ]);

        document.getElementById('inputEditRepeatPassword') &&
            validator.addField('#inputEditRepeatPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    validator: (value, fields) => {
                        if (
                            fields['#inputEditNewPassword'] &&
                            fields['#inputEditNewPassword'].elem
                        ) {
                            const repeatPasswordValue =
                                fields['#inputEditNewPassword'].elem.value;

                            return value === repeatPasswordValue;
                        }

                        return true;
                    },
                    errorMessage: 'Паролі не співпадають',
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
                    $('#modal-edit-password button.modal__close').click()
                    throwSuccessToaster(response.message);
                },
                error: function (jqXHR) {
                    if (jqXHR.status === 422) {
                        for (let input in jqXHR?.responseJSON.errors) {
                            $(`[name="${input}"]`)
                                .addClass('just-validate-error-field')
                                .one('input', function (e) {
                                    $(this).next().remove()
                                })
                                .after(`<div class="error-label just-validate-error-label" style="color: rgb(184, 17, 17);">${jqXHR?.responseJSON.errors[input]}</div>`)
                        }
                    } else {
                        throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
                        $('#modal-edit-password button.modal__close').click()
                    }
                }
            })
        });
    }
}

export default passwordFormValidation;
