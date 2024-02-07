const loadMore = () => {
    const loadMoreAll = document.querySelectorAll('.collection-descr');

    loadMoreAll?.forEach(item => {
        const loadMoreToggle = item.querySelector('.collection-descr__more');
        const loadMoreHidden = item.querySelector('.collection-descr__hidden');

        loadMoreToggle?.addEventListener('click', function () {
            loadMoreHidden.classList.toggle('is-visible');
            loadMoreToggle.classList.toggle('is-active');

            let previousShortEl = this.previousElementSibling.children[0];

            if (loadMoreToggle.querySelector('span').innerText === 'Читати детальніше') {
                if (previousShortEl.innerText.slice(-3) === '...') {
                    previousShortEl.innerText = previousShortEl.innerText.slice(0, -3);
                }
                loadMoreToggle.querySelector('span').innerText = 'Згорнути';
            } else {
                previousShortEl.innerText = previousShortEl.innerText + '...';
                loadMoreToggle.querySelector('span').innerText = 'Читати детальніше';
            }

        });
    });

}

export default loadMore;
