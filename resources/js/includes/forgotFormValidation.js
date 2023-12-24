import JustValidate from 'just-validate';

const forgotFormValidation = () => {
    if (document.getElementById('forgot-form')) {
        const validator = new JustValidate('#forgot-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputForgotPhone') &&
            validator.addField('#inputForgotPhone', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'customRegexp',
                    value: /\+38\s?\(\d{3}\)\s?\d{2}-\d{2}-\d{3,4}/,
                    errorMessage: 'Некоректний формат номеру телефона'
                }
            ]);
        validator.onSuccess((ev) => {
            ev.currentTarget.submit()
        })
    }
}

export default forgotFormValidation;
