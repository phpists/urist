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
        // Navigator clipboard api needs a secure context (https)
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
        } else {
            // Use the 'out of viewport hidden text area' trick
            const textArea = document.createElement("textarea");
            textArea.value = text;

            // Move textarea out of the viewport so it's not visible
            textArea.style.position = "absolute";
            textArea.style.left = "-999999px";

            document.body.prepend(textArea);
            textArea.select();

            try {
                document.execCommand('copy');
            } catch (error) {
                console.error(error);
            } finally {
                textArea.remove();
            }
        }
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}
