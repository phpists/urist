import JustValidate from 'just-validate';

const loginFormValidation = () => {
    if (document.getElementById('login-form')) {
        const validator = new JustValidate('#login-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputLoginPhone') &&
            validator.addField('#inputLoginPhone', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputLoginPassword') &&
            validator.addField('#inputLoginPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        validator.onSuccess((event) => {
            event.currentTarget.submit();
        });
    }
}

export default loginFormValidation;
