const homePage = () => {
    document.querySelectorAll('button.redirect-btn').forEach((el) => {
        el.addEventListener('click', (ev) => {
            location.href = ev.currentTarget.dataset.link;
        })
    })
}

export default homePage;
