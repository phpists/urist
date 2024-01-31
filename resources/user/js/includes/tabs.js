class Tabs {
    constructor(selector, options) {
        let defaultOptions = {
            isChanged: () => {},
            active: 0,
            transition: 500,
        }

        this.options = Object.assign(defaultOptions, options); 
        this.selector = selector; 
        this.tabs = document.querySelector(`[data-tabs="${selector}"]`); 
        this.contents = document.querySelector(`[data-tabs-content="${selector}"]`);

        if (this.tabs) { 
            this.tabsList = this.tabs.querySelector('.tabs__nav');
            this.tabsBtns = this.tabsList.querySelectorAll('.tabs__nav-btn'); 
            this.tabsPanels = this.contents.querySelectorAll('.tabs-panel'); 
        } else {
            console.error('Селектор data-tabs не существует');
            return;
        }

        this.check(); 
        this.init();
        this.events(); 
    }

    check() { 
        if (document.querySelectorAll(`[data-tabs="${this.selector}"]`).length > 1) { 
            console.error('Количество элементов с одинаковым data-tabs больше одного')
            return
        }

        if (this.tabsBtns.length !== this.tabsPanels.length) { 
            console.error('Количество кнопок и табов не совпадает');
            return;
        }
    }

    init() { 
        this.tabsList.setAttribute('role', 'tablist'); 

        this.tabsBtns.forEach((el, i) => { 
            el.setAttribute('role', 'tab'); 
            el.setAttribute('tabindex', '-1'); 
            el.setAttribute('id', `${this.selector}${i + 1}`); 
            el.classList.remove('is-active'); 
        })

        this.tabsPanels.forEach((el, i) => { 
            el.setAttribute('role', 'tabpanel'); 
            el.setAttribute('tabindex', '-1'); 
            el.setAttribute('aria-labelledby', this.tabsBtns[i].id);
            el.classList.remove('is-active'); 
            el.style.display = 'none'; 
        })

        this.index = this.tabs.dataset.active || this.options.active; 

        this.tabsBtns[this.index].classList.add('is-active'); 
        this.tabsBtns[this.index].removeAttribute('tabindex'); 
        this.tabsBtns[this.index].setAttribute('aria-selected', 'true'); 
        this.tabsPanels[this.index].classList.add('is-active'); 
        this.tabsPanels[this.index].style.display = 'block'; 
    }

    events() { 
        this.tabsBtns.forEach((el, i) => { 
            el.addEventListener('click', (e) => { 
                let currentTab = this.tabsList.querySelector('[aria-selected]'); 
                
                (e.currentTarget !== currentTab) && this.switchTabs(e.currentTarget, currentTab); 
            })

            el.addEventListener('keydown', (e) => { 
                let index = Array.prototype.indexOf.call(this.tabsBtns, e.currentTarget); 

                (e.which === 37) ? this.switchTabs(this.tabsBtns[index - 1], e.currentTarget) :
                (e.which === 39) ? this.switchTabs(this.tabsBtns[index + 1], e.currentTarget) :
                (e.which === 40) ? this.tabsPanels[i].focus() : null;
            })
        })
    }

    switchTabs(newTab, oldTab) { 
        let newIndex = Array.prototype.indexOf.call(this.tabsBtns, newTab); 
        let oldIndex = Array.prototype.indexOf.call(this.tabsBtns, oldTab); 
        
        newTab.focus(); 
        newTab.removeAttribute('tabindex'); 
        newTab.setAttribute('aria-selected', 'true'); 

        this.tabsPanels[newIndex].classList.add('is-active'); 
        this.tabsBtns[newIndex].classList.add('is-active');

        oldTab.removeAttribute('aria-selected'); 
        oldTab.setAttribute('tabindex', '-1'); 
        
        this.tabsPanels[oldIndex].classList.remove('is-active');
        this.tabsBtns[oldIndex].classList.remove('is-active'); 

        this.tabsPanels[newIndex].style.opacity = 0;
        this.tabsPanels[oldIndex].style.opacity = 0;
        this.tabsPanels[newIndex].style.transition = `opacity ${this.options.transition}ms`;
        this.tabsPanels[oldIndex].style.transition = `opacity ${this.options.transition}ms`;

        setTimeout(() => {
            this.tabsPanels[newIndex].style.display = 'block';
            this.tabsPanels[newIndex].style.opacity = 1;
            this.tabsPanels[oldIndex].style.display = 'none';
        }, this.options.transition);

        this.options.isChanged(this);
    }
}

export default Tabs;