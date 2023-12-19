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
            ]);
    }
}

export default forgotFormValidation;