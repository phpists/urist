import JustValidate from 'just-validate';

const fileFormValidation = () => {
    if (document.getElementById('file-form')) {
        const validator = new JustValidate('#file-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputFileTitle') &&
            validator.addField('#inputFileTitle', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
        document.getElementById('selectFileFolder') &&
            validator.addField('#selectFileFolder', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
    }
}

export default fileFormValidation;