const closeAlert = () => {
    const alertAll = document.querySelectorAll('.alert');
    const activeAlert = document.querySelector('.alert.is-visible');

    alertAll?.forEach(item => {
        item.addEventListener('click', function() {
            item.classList.remove('is-visible');
        });
    });

    setTimeout(() => {
        document.addEventListener('click', function (event) {
            if (!event.handled) {
                activeAlert?.classList.remove('is-visible');
                event.handled = true;
            }
        }, {once: true});
    }, 300)

    setTimeout(() => {
        activeAlert?.classList.remove('is-visible');
    }, 3000);
}

export default closeAlert;
