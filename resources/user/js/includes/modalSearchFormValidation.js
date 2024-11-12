import JustValidate from 'just-validate';
import {closeModal} from "./modal.js";

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

        validator.onSuccess((event) => {
            event.preventDefault();
            this.dispatchEvent(new Event('submit'))
            closeModal(document.getElementById('modal-search'))
        });
    }
}

export default modalSearchFormValidation;
