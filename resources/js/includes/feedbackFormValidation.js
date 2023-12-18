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
            ]);

        document.getElementById('inputEmail') &&
            validator.addField('#inputEmail', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('textareaFeedback') &&
            validator.addField('#textareaFeedback', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('checkboxAgree') &&
            validator.addField('#checkboxAgree', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
    }
}

export default feedbackFormValidation;