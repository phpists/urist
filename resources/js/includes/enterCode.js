const enterCode = () => {
    const codeInputAll = document.querySelectorAll('.form__code .input');

    codeInputAll.forEach(item => {
        item.addEventListener('keyup', function() {
            const next = this.closest('.form__code-item').nextElementSibling;

            if ((this.value.match(/^\d{1}$/)) && next) {
                next.querySelector('.input').focus();
            }
        });

        item.addEventListener('keydown', function(event) {
            const prev = this.closest('.form__code-item').previousElementSibling;

            if ((this.value === "") && (event.keyCode === 8) && (prev)) {
                prev.querySelector('.input').focus();
            }
        });
    });

}

export default enterCode;
