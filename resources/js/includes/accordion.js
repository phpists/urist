const accordion = () => {
    const accordionAll = document.querySelectorAll('.accordion');

    accordionAll.forEach(item => {
        const accordionToggle = item.querySelector('.accordion__toggle');
        const accordionDropdown = item.querySelector('.accordion__content');
        
        if (accordionToggle) {
            accordionToggle.addEventListener('click', () => {
                accordionToggle.closest('.accordion').classList.toggle('is-open');

                accordionToggle.closest('.accordion.is-open')
                    ? accordionDropdown.style.maxHeight = accordionDropdown.scrollHeight + 'px'
                    : accordionDropdown.style.maxHeight = null;
            });

            accordionToggle.closest('.accordion.is-open')
                ? accordionDropdown.style.maxHeight = accordionDropdown.scrollHeight + 'px'
                : accordionDropdown.style.maxHeight = null;
        }
    });
}

export default accordion;