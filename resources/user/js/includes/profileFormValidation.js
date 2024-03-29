import JustValidate from 'just-validate';

const profileFormValidation = () => {
    if (document.getElementById('profile-form')) {
        const validator = new JustValidate('#profile-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputFirstName') &&
            validator.addField('#inputFirstName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputLastName') &&
            validator.addField('#inputLastName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputEmail') &&
            validator.addField('#inputEmail', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'email',
                    errorMessage: "Вкажіть валідну email-адресу",
                },
            ]);

        document.getElementById('inputPhone') &&
            validator.addField('#inputPhone', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputDate') &&
            validator.addField('#inputDate', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('selectCity') &&
            validator.addField('#selectCity', [
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
                }
            })
        });
    }
}

export default profileFormValidation;
