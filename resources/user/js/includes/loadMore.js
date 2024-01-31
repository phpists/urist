const loadMore = () => {    
    const loadMoreAll = document.querySelectorAll('.collection-descr');

    loadMoreAll?.forEach(item => {
        const loadMoreToggle = item.querySelector('.collection-descr__more');
        const loadMoreHidden = item.querySelector('.collection-descr__hidden');

        loadMoreToggle?.addEventListener('click', () => {
            loadMoreHidden.classList.toggle('is-visible');
            loadMoreToggle.classList.toggle('is-active');
            
            loadMoreToggle.querySelector('span').innerText = 
                loadMoreToggle.querySelector('span').innerText === 'Читати детальніше' 
                    ? 'Згорнути' 
                    : 'Читати детальніше';
        });
    });

    
}

export default loadMore;