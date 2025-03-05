const filterToggle = () => {
    const filterCollapseButton = document.querySelectorAll('[data-filter-collapse]');
    const filterInner = document.querySelector('.filter__inner');
    const filterHeader = document.querySelector('.filter__sticky-header');

    filterCollapseButton?.forEach(button => {
        button.addEventListener('click', () => {
            filterHeader?.classList.toggle('is-visible');
            filterInner?.classList.toggle('is-header-visible');
        });
    });

    function scrollDetect() {
        if (window.innerWidth < 768) {
            if ( filterInner?.scrollTop > 0 ) {
                filterHeader?.classList.add('is-visible');
                filterInner?.classList.add('is-header-visible');
            } else {
                filterHeader?.classList.remove('is-visible');
                filterInner?.classList.remove('is-header-visible');
            }
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        scrollDetect();

        filterInner?.addEventListener('scroll', function() {
            scrollDetect();
        });
    });
}

export default filterToggle;
