import JustValidate from 'just-validate';

const registrationFormValidation = () => {
    if (document.getElementById('registration-form')) {
        const validator = new JustValidate('#registration-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputRegName') &&
            validator.addField('#inputRegName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'minLength',
                    value: 3,
                    errorMessage: "Мінімальна кількість 3 символи",
                },
            ]);
        let phoneInp = document.getElementById('inputRegPhone');
        phoneInp &&
            validator.addField('#inputRegPhone', [
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
        phoneInp.addEventListener('input', () => {
            let errorLabel = document.querySelector('#inputRegPhone + .error-label');
            if (errorLabel) {
                errorLabel.remove();
            }
            validator.revalidateField('#inputRegPhone').then((isValid) => {
            });
        })
        let passwordInp = document.getElementById('inputRegPassword');

        const customPasswordRules = [
            {
                errorMessage: "Пароль має містити хоча б одну літеру",
                validator: (value) => {
                    return /[a-zA-Z:]/.test(value);
                }
            },
            {
                errorMessage: "Пароль має містити хоча б одну цифру",
                validator: (value) => {
                    return /\d/.test(value);
                }
            },
            {
                errorMessage: "Пароль має містити символ",
                validator: (value) => {
                    return /[^a-zA-Z\d\s:]/.test(value);
                }
            },
            {
                errorMessage: "Пароль має містити хоча б 8 символів",
                validator: (value) => {
                    return value.length >= 8;
                }
            },
        ];
        passwordInp &&
        validator.addField('#inputRegPassword', [
            {
                rule: 'required',
                errorMessage: "Заповніть це поле",
            },
            ...customPasswordRules
        ]);
        let formPass = document.querySelector('.form-pass__power');
        passwordInp.addEventListener('input', () => {
            formPass.setAttribute('data-pass-power', "0");
            customPasswordRules.some((rule, idx) => {
                if (rule.validator(passwordInp.value)) {
                    formPass.setAttribute('data-pass-power', idx + 1);
                    validator.showSuccessLabels({'#inputRegPassword': ''})
                    return false
                }
                else {
                    validator.showErrors({'#inputRegPassword': rule.errorMessage})
                    return true;
                }
            })
        })

        document.getElementById('inputConfirmRegPassword') &&
            validator.addField('#inputConfirmRegPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    validator: (value, context) => passwordInp.value === value,
                    errorMessage: 'Паролі не співпадають'
                }
            ]);

        document.getElementById('checkboxRegAgree') &&
            validator.addField('#checkboxRegAgree', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('checkboxRegAccept') &&
            validator.addField('#checkboxRegAccept', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        validator.onSuccess(( event ) => {
            event.currentTarget.submit();
        });
    }
}

export default registrationFormValidation;
