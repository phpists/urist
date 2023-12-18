const mobileNav = () => {
    const body = document.querySelector('body');
    const header = document.querySelector('.header');
    const mobileNav = document.querySelector(".mobile-nav");
    const mobileNavToggle = document.querySelector("[data-nav-toggle]");
    const paddingRight = window.innerWidth - document.documentElement.clientWidth;
    
    mobileNavToggle?.addEventListener('click', e => {
        e.preventDefault();
        mobileNavShowHide();
    });

    mobileNav?.addEventListener('click', e => {
        if (!e.target.closest('.mobile-nav__sidebar')) {
            mobileNavShowHide();
        }
    });

    function mobileNavShowHide() {
        header?.classList.toggle('is-active');
        mobileNav?.classList.toggle('is-visible');
        mobileNavToggle?.classList.toggle('is-active');

        if (mobileNav.classList.contains('is-visible')) {
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

export default mobileNav;