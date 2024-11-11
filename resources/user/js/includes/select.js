import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css';

const select = () => {
    const selectAll = document.querySelectorAll('.select:not(.initialized)');

    selectAll?.forEach(item => {
        const select = new Choices(item, {
            allowHTML: true,
            placeholder: true,
            searchEnabled: false,
            shouldSort: false,
        });
        item.classList.add('initialized');
    });
}

export default select;
