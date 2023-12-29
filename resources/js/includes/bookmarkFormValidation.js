import JustValidate from 'just-validate';

const bookmarkFormValidation = () => {
    if (document.getElementById('bookmark-form')) {
        const validator = new JustValidate('#bookmark-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('selectBookmarkFolder') &&
            validator.addField('#selectBookmarkFolder', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);
        
    }
}

export default bookmarkFormValidation;