import JustValidate from 'just-validate';

const feedbackFormValidation = () => {
    if (document.getElementById('feedback-form')) {
        const validator = new JustValidate('#feedback-form', {
            errorLabelCssClass: ['error-label'],
        });

        document.getElementById('inputName') &&
            validator.addField('#inputName', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'minLength',
                    value: 3,
                    errorMessage: "Мінімальна кількість 3 символи",
                },
            ]);

        document.getElementById('inputEmail') &&
            validator.addField('#inputEmail', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'email',
                    errorMessage: "Некоректний формат email"
                }
            ]);

        document.getElementById('textareaFeedback') &&
            validator.addField('#textareaFeedback', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
                {
                    rule: 'minLength',
                    value: 30,
                    errorMessage: "Мінімальна кількість 30 символів",
                },
            ]);

        document.getElementById('checkboxAgree') &&
            validator.addField('#checkboxAgree', [
                {
                    rule: 'required',
                    errorMessage: "Заповніть це поле",
                },
            ]);

        validator.onSuccess(( event ) => {
            let $form = $(event.currentTarget);

            console.log($form)

            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                dataType: 'json',
                data: $form.serialize(),
                success: function (response) {
                    $form.find('button[data-modal]').click()
                    $form[0].reset()

                    throwSuccessToaster('Повідомлення успішно відправлено. Ми зв\'яжемося з вами найближчим часом')
                }
            })
        });
    }
}

export default feedbackFormValidation;
