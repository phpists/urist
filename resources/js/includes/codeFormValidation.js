import JustValidate from 'just-validate';

const codeFormValidation = () => {
    if (document.getElementById('code-form')) {
        const validator = new JustValidate('#code-form', {
            errorLabelCssClass: ['error-label'],
        });
        let hasInputStarted = false;
        let codeInputs = document.querySelectorAll('.code_input');
        codeInputs.forEach((el) => {
            el &&
            validator.addField('#' + el.id, [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                }
            ]);
            el.addEventListener('input', () => {
                if (!hasInputStarted) {
                    hasInputStarted = true;
                    document.querySelector('.just-validate-error-label').remove();
                }
            })
        })
        validator.onSuccess(( event ) => {
            event.currentTarget.submit();
        });
    }
}

export default codeFormValidation;
