import SmoothScroll from 'smooth-scroll/src/js/smooth-scroll/smooth-scroll';

const scrollToId = () => {
    const headerHeight = document.querySelector('.header').offsetHeight;

    new SmoothScroll('[data-scroll]', { 
        speed: 100,
        speedAsDuration: true,
        offset: headerHeight,
        updateURL: false,
    });
}

export default scrollToId;