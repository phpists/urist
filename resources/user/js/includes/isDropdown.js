const isDropdown = () => {

    $(document).on('click', '.is-dropdown', function (e) {
        const activeItem = $('.is-dropdown.is-active')[0] ?? null;

        e.preventDefault();

        if (activeItem != this) {
            activeItem?.classList.remove('is-active');
        }

        this.classList.toggle('is-active');
    })

    $(document).on('click', 'body', function (e) {
        const isDropdown = e.target.closest('.is-dropdown');

        if (!isDropdown) {
            $('.is-dropdown').each((i, item) => {
                item.classList.remove('is-active');
            });
        }
    })

}

export default isDropdown;
