import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const reviewsSlider = () => {
    new Swiper('.reviews-slider', {
        modules: [Navigation, Pagination],
        spaceBetween: 30,
        slidesPerView: 3,
        loop: true,
        centeredSlides: true,
        observer: true,
        speed: 700,
        observeParents: true,
        watchOverflow: true,
        navigation: {
            nextEl: '.reviews-slider__next',
            prevEl: '.reviews-slider__prev',
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            992: {
                slidesPerView: 3,
            },
        },
    });
}

export default reviewsSlider;