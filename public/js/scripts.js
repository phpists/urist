document.addEventListener('DOMContentLoaded', function () {

    const modalSelfCompletingBts = document.querySelectorAll('.modal-self-completing');

    if (modalSelfCompletingBts.length > 0) {
        modalSelfCompletingBts.forEach((item) => {
            item.addEventListener('click', function (e) {

                let action = this.dataset.action ?? null,
                    json = this.dataset.json,
                    form = document.getElementById(this.dataset.modal).querySelector('form');

                if (form) {
                    if (action)
                        form.action = action;

                    try {
                        let values = JSON.parse(json);

                        for (let field in values) {
                            let formField = form.querySelector(`[name="${field}"]`)
                            if (formField)
                                formField.value = values[field]
                        }
                    } catch (e) {
                    }
                }
            })
        })
    }

})



const copyText = async (text) => {
    try {
        await navigator.clipboard.writeText(text);
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}
