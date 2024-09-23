import { openModal, closeModal } from './modal.js';

const tips = () => {
    function handleToggleClick(e) {
        e.preventDefault();
        e.stopPropagation();

        const modalID = this.getAttribute("data-modal-once");
        const modal = document.getElementById(modalID);
        const modalVisible = document.querySelector(".modal.is-visible");
        const tipsToggleAll = document.querySelectorAll(`[data-modal-once="${modalID}"]`);

        if (!modal)
            return;

        e.preventDefault();

        if (modalVisible) {
            modalVisible.classList.remove('is-visible');

            setTimeout(() => {
                openModal(modal);
            }, 250);
        } else {
            openModal(modal);
        }

        if (tipsToggleAll.length > 1) {
            tipsToggleAll.forEach(item => {
                item.removeEventListener('click', handleToggleClick);
            });
        }

        // if (modalID === 'modal-tip-7') {
        //     const tipsToggle = document.querySelector(`[data-modal-once="${modalID}"]`);
        //     const logo = document.querySelector('.logo__link');
        //
        //     tipsToggle?.setAttribute('data-modal-once', 'modal-tip-14');
        //     tipsToggle?.addEventListener('click', handleToggleClick, { once: true });
        //
        //     logo?.setAttribute('data-modal-once', 'modal-tip-14');
        //     logo?.addEventListener('click', handleToggleClick, { once: true });
        // }

        // if (modalID === 'modal-tip-3') {
        //     const filterHideButton = document.querySelector('.filter__hide-button');
        //
        //     filterHideButton?.setAttribute('data-modal-once', 'modal-tip-12');
        //     filterHideButton?.addEventListener('click', handleToggleClick, { once: true });
        // }
    }

    setInterval(() => {
        const modalToggleOnceAll = document.querySelectorAll("[data-modal-once]");

        modalToggleOnceAll.forEach(item => {
            const modalID = item.getAttribute("data-modal-once");
            const modal = document.getElementById(modalID);

            if (modal) {
                item.addEventListener('click', handleToggleClick, {once: true});
            } else {
                item.removeAttribute('data-modal-once');
            }
        });
    }, 100);

    // first modal
    const firstModal = document.getElementById('modal-tip-1');
    if (firstModal)
        openModal(firstModal);

    // second modal
    const secondModal = document.getElementById('modal-tip-2');
    if (!firstModal && secondModal)
        openModal(secondModal);

    // third modal
    if (location.pathname.includes('/articles/kpk') || location.pathname.includes('/articles/kk')) {
        const thirdModal = document.getElementById('modal-tip-3');
        if (thirdModal)
            openModal(thirdModal);
    }

    // third modal
    const openFilterBtn = document.querySelector('.filter.is-hide .filter__hide-button');
    openFilterBtn?.addEventListener('click', function (e) {
        const thirdModal = document.getElementById('modal-tip-3');
        if (thirdModal)
            openModal(thirdModal);

        const closeFilterBtn = document.querySelector('.filter:not(.is-hide) .filter__hide-button');
        closeFilterBtn?.addEventListener('click', function (e) {
            const modal = document.getElementById('modal-tip-12');
            if (modal)
                openModal(modal);
        }, { once: true });
    }, { once: true });
    const closeFilterBtn = document.querySelector('.filter:not(.is-hide) .filter__hide-button');
    closeFilterBtn?.addEventListener('click', function (e) {
        const modal = document.getElementById('modal-tip-12');
        if (modal)
            openModal(modal);
    }, { once: true });

    // seventh modal
    const openSidebarBtn = document.querySelector('.filter__burger:not(.active)');
    openSidebarBtn?.addEventListener('click', function (e) {
        const modal = document.getElementById('modal-tip-7');
        if (modal)
            openModal(modal);

        const closeSidebarBtn = document.querySelector('.filter__burger.is-active');
        closeSidebarBtn?.addEventListener('click', function (e) {
            const modal = document.getElementById('modal-tip-14');
            if (modal)
                openModal(modal);
        }, { once: true });
    }, { once: true });


    document.querySelectorAll('.modal--tip').forEach(item => {
        const welcomeHintId = item.id.replace(/\D/g, "");
        item.querySelector('.modal__ok-button').addEventListener('click', async function (e) {
            const response = await fetch('/welcome-hints/' + welcomeHintId, {
                method: 'POST',
            })
            if (response.ok)
                item.remove()
            document.querySelectorAll(`[data-modal-once="${item.id}"]`).forEach(item => {
                item.removeAttribute('data-modal-once');
            })
        }, { once: true });
    })

}

export default tips;
