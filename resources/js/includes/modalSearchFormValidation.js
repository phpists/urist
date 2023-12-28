import JustValidate from 'just-validate';

const modalSearchFormValidation = () => {
    if (document.getElementById('modal-search-form')) {
        const validator = new JustValidate('#modal-search-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputModalSearch') &&
            validator.addField('#inputModalSearch', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
    }
}

export default modalSearchFormValidation;