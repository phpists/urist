const closeAlert = () => {
    const alertAll = document.querySelectorAll('.alert');
    const activeAlert = document.querySelector('.alert.is-visible');
    
    alertAll?.forEach(item => {
        item.addEventListener('click', function() {
            item.classList.remove('is-visible');
        });
    });

    setTimeout(() => {
        activeAlert?.classList.remove('is-visible');
    }, 5000);
}

export default closeAlert;