import Swiper, { Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

const tariffsSlider = () => {
    new Swiper('.tariffs-slider', {
        modules: [Pagination],
        spaceBetween: 30,
        slidesPerView: 2,
        loop: true,
        centeredSlides: false,
        observer: true,
        speed: 700,
        observeParents: true,
        watchOverflow: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
    });
}

export default tariffsSlider;