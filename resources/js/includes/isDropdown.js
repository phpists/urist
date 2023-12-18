const isDropdown = () => {
    const body = document.querySelector('body');
    const dropdownAll = document.querySelectorAll('.is-dropdown');
    

    dropdownAll?.forEach(item => {
        const dropdownToggle = item.querySelector('.is-dropdown__toggle');
        
        dropdownToggle?.addEventListener('click', function(e) {
            const activeItem = document.querySelector('.is-dropdown.is-active');
            
            e.preventDefault();

            if (activeItem != item) {
                activeItem?.classList.remove('is-active');
            }
            
            item.classList.toggle('is-active');
        });
    });

    body.addEventListener('click', e => {
        const isDropdown = e.target.closest('.is-dropdown');

        if (!isDropdown) {
            dropdownAll?.forEach(item => {
                item.classList.remove('is-active');
            });
        }
    });
}

export default isDropdown;