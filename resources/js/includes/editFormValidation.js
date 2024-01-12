import JustValidate from 'just-validate';

const createFormValidation = () => {
    if (document.getElementById('edit-form')) {
        const validator = new JustValidate('#edit-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputEditFolderTitle') &&
            validator.addField('#inputEditFolderTitle', [
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

export default createFormValidation;
