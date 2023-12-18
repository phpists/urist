import JustValidate from 'just-validate';

const passwordFormValidation = () => {
    if (document.getElementById('password-form')) {
        const validator = new JustValidate('#password-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputNewPassword') &&
            validator.addField('#inputNewPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputConfirmNewPassword') &&
            validator.addField('#inputConfirmNewPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
    }
}

export default passwordFormValidation;