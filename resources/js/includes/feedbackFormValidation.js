import JustValidate from 'just-validate';

const feedbackFormValidation = () => {
    if (document.getElementById('feedback-form')) {
        const validator = new JustValidate('#feedback-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputName') &&
            validator.addField('#inputName', [
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

        document.getElementById('inputEmail') &&
            validator.addField('#inputEmail', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'email',
                    errorMessage: "Некоректний формат email"
                }
            ]);

        document.getElementById('textareaFeedback') &&
            validator.addField('#textareaFeedback', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'minLength',
                    value: 30,
                    errorMessage: "Мінімальна кількість 30 символів",
                },
            ]);

        document.getElementById('checkboxAgree') &&
            validator.addField('#checkboxAgree', [
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

export default feedbackFormValidation;
