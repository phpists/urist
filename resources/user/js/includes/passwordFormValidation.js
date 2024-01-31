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
            ]);
        
        document.getElementById('inputEditRepeatPassword') &&
            validator.addField('#inputEditRepeatPassword', [
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

export default passwordFormValidation;