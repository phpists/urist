const loadMore = () => {    
    const loadMoreToggle = document.querySelector('.seo-section__more');
    const loadMoreText = document.querySelector('.seo-section__text');
    
    loadMoreToggle?.addEventListener('click', () => {
        loadMoreText.classList.toggle('is-visible');
        loadMoreText.style.maxHeight = loadMoreText.scrollHeight + 'px';
        loadMoreToggle.remove();
    });
}

export default loadMore;