import JustValidate from 'just-validate';

const createFormValidation = () => {
    if (document.getElementById('create-form')) {
        const validator = new JustValidate('#create-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputCreateFolderTitle') &&
            validator.addField('#inputCreateFolderTitle', [
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

export default createFormValidation;