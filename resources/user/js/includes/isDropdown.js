const isDropdown = () => {

    $(document).on('click', '.is-dropdown .is-dropdown__toggle', function (e) {
        const activeItem = document.querySelector('.is-dropdown.is-active'),
            parent = this.parentNode;

        e.preventDefault();

        if (activeItem != parent) {
            activeItem?.classList.remove('is-active');
        }

        parent.classList.toggle('is-active');
    })

    $(document).on('click', 'body', function (e) {
        const isDropdown = e.target.closest('.is-dropdown');

        if (!isDropdown) {
            $('.is-dropdown').removeClass('is-active');
        }
    })

}

export default isDropdown;
