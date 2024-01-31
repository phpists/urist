import JustValidate from 'just-validate';

const searchFormValidation = () => {
    if (document.getElementById('search-form')) {
        const validator = new JustValidate('#search-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputSearch') &&
            validator.addField('#inputSearch', [
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

export default searchFormValidation;