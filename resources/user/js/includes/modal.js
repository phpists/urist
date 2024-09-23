const body = document.querySelector("body");
const header = document.querySelector(".header");
const modalWrap = document.querySelector(".modal-wrap");
const paddingRight = window.innerWidth - document.documentElement.clientWidth;


const modal = () => {

    $(document).on('click', '[data-modal]', function (e) {
        if (this.hasAttribute('data-modal-once'))
            return;

        const $modalVisible = $(".modal.is-visible");

        e.preventDefault();

        const modal = $('#' + $(this).data('modal'))[0] ?? null;

        if (modal) {
            if ($modalVisible.length > 0) {
                $modalVisible.removeClass('is-visible');

                setTimeout(() => {
                    openModal(modal);
                }, 250);
            } else {
                openModal(modal);
            }
        }
    })

    $(document).on('click', '.modal', function (e) {
        if (!e.target.closest('.modal__window')) {
            closeModal(this);
        }
    })

    $(document).on('click', '[data-modal-close]', function (e) {
        closeModal(this.closest(".modal"));
    })
}

export const openModal = (modal) => {
    body.classList.add('scroll-disabled');
    // body.style.paddingRight = paddingRight + 'px';
    // header.style.paddingRight = paddingRight + 'px';
    modalWrap.classList.add('is-visible');
    modal.classList.add('is-visible');

    const video = modal.querySelector('#youtube-video');
    if (video) {
        video.src += '&autoplay=1';
    }
}
export const closeModal = (modal) => {
    modalWrap.classList.remove('is-visible');
    modal.classList.remove('is-visible');

    if (!header.classList.contains('is-active')) {
        setTimeout(() => {
            body.classList.remove('scroll-disabled');
            body.style.paddingRight = '0px';
            header.style.paddingRight = '0px';
        }, 500);
    }

    const video = modal.querySelector('#youtube-video');
    if (video) {
        video.src = video.src.replace('&autoplay=1', '');
    }
}

export default modal;
