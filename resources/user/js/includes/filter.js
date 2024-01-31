const filter = () => {
    const body = document.querySelector('body');
    const header = document.querySelector('.header');
    const main = document.querySelector('.main');
    const filterNav = document.querySelector(".filter");
    const filterNavToggleAll = document.querySelectorAll("[data-filter-toggle]");
    const filterNavHide = document.querySelector("[data-filter-hide]");
    const paddingRight = window.innerWidth - document.documentElement.clientWidth;
    
    filterNavToggleAll?.forEach(item => {
        item?.addEventListener('click', e => {
            e.preventDefault();
            filterNavShowHide();
        });
    });

    filterNav?.addEventListener('click', e => {
        if (!e.target.closest('.filter__panel')) {
            filterNavShowHide();
        }
    });

    filterNavHide?.addEventListener('click', () => {
        filterNav?.classList.toggle('is-hide');
        header?.classList.toggle('is-full');
        main?.classList.toggle('is-full');
    });

    const filterShowHide = () => {
        if (window.innerWidth < 1170) {
            filterNav?.classList.add('is-hide');
            header?.classList.add('is-full');
            main?.classList.add('is-full');
        } else {
            // filterNav?.classList.remove('is-hide');
            // header?.classList.remove('is-full');
            // main?.classList.remove('is-full');
        } 
    }

    filterShowHide();

    if (window.attachEvent) {
        window.attachEvent('onresize', function() {
            filterShowHide();
        });
    } else if (window.addEventListener) {
        window.addEventListener('resize', function() {
            filterShowHide();
        }, true);
    }

    function filterNavShowHide() {
        header?.classList.toggle('is-active');
        filterNav?.classList.toggle('is-visible');

        filterNavToggleAll?.forEach(item => {
            item?.classList.toggle('is-active');
        });

        if (filterNav.classList.contains('is-visible')) {
            body.classList.add('scroll-disabled');
            body.style.paddingRight = paddingRight + 'px';
            header.style.paddingRight = paddingRight + 'px';
        } else {
            setTimeout(() => {
                body.classList.remove('scroll-disabled');
                body.style.paddingRight = '0px';
                header.style.paddingRight = '0px';
            }, 500);
        }
    }
}

export default filter;