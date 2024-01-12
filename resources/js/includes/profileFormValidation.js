import JustValidate from 'just-validate';

const profileFormValidation = () => {
    if (document.getElementById('profile-form')) {
        const validator = new JustValidate('#profile-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputFirstName') &&
            validator.addField('#inputFirstName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputLastName') &&
            validator.addField('#inputLastName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputEmail') &&
            validator.addField('#inputEmail', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('inputPhone') &&
            validator.addField('#inputPhone', [
            ]);

        document.getElementById('inputDate') &&
            validator.addField('#inputDate', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        document.getElementById('selectCity') &&
            validator.addField('#selectCity', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        validator.onSuccess(( event ) => {
            console.log(event.currentTarget);
            event.currentTarget.submit();
        });

    }
}

export default profileFormValidation;
