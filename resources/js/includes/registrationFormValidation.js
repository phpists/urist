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
            ]);

        document.getElementById('inputRegPhone') &&
            validator.addField('#inputRegPhone', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputRegPassword') &&
            validator.addField('#inputRegPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputConfirmRegPassword') &&
            validator.addField('#inputConfirmRegPassword', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
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
    }
}

export default registrationFormValidation;