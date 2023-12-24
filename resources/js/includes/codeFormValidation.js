import JustValidate from 'just-validate';

const codeFormValidation = () => {
    if (document.getElementById('code-form')) {
        const validator = new JustValidate('#code-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputCode') &&
            validator.addField('#inputCode', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'minLength',
                    value: 4,
                    errorMessage: "Мінімальна к-сть символів",
                },
                {
                    rule: 'maxLength',
                    value: 4,
                    errorMessage: "Максимальна к-сть символів",
                },
            ]);
        validator.onSuccess(( event ) => {
            event.currentTarget.submit();
        });

        // document.getElementById('inputCode2') &&
        //     validator.addField('#inputCode2', [
        //         {
        //             rule: 'required',
        //             errorMessage: "Заповніть це поле",
        //         },
        //     ]);
        //
        // document.getElementById('inputCode3') &&
        //     validator.addField('#inputCode3', [
        //         {
        //             rule: 'required',
        //             errorMessage: "Заповніть це поле",
        //         },
        //     ]);
        //
        // document.getElementById('inputCode4') &&
        //     validator.addField('#inputCode4', [
        //         {
        //             rule: 'required',
        //             errorMessage: "Заповніть це поле",
        //         },
        //     ]);
    }
}

export default codeFormValidation;
