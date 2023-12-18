import JustValidate from 'just-validate';

const codeFormValidation = () => {
    if (document.getElementById('code-form')) {
        const validator = new JustValidate('#code-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputCode1') &&
            validator.addField('#inputCode1', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputCode2') &&
            validator.addField('#inputCode2', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputCode3') &&
            validator.addField('#inputCode3', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('inputCode4') &&
            validator.addField('#inputCode4', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
    }
}

export default codeFormValidation;