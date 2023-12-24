import JustValidate from 'just-validate';

const passwordFormValidation = () => {
    if (document.getElementById('password-form')) {
        const validator = new JustValidate('#password-form', {
            errorLabelCssClass: ['error-label'],
        });
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
        let passwordInp = document.getElementById('inputNewPassword');
        passwordInp &&
            validator.addField('#inputNewPassword', [
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
                    validator.showSuccessLabels({'#inputNewPassword': ''})
                    return false
                }
                else {
                    validator.showErrors({'#inputNewPassword': rule.errorMessage})
                    return true;
                }
            })
        })

        document.getElementById('inputConfirmNewPassword') &&
            validator.addField('#inputConfirmNewPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    validator: (value, context) => passwordInp.value === value,
                    errorMessage: 'Паролі не співпадають'
                }
            ]);
        validator.onSuccess((ev) => {
            ev.currentTarget.submit();
        })
    }
}

export default passwordFormValidation;
