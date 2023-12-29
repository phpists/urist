const newAccordion = () => {
    const accordion = document.querySelector(".accordion");
    
    const accordionTriggerAll = document.querySelectorAll(".accordion__trigger");

    accordionTriggerAll?.forEach(item => {
        item.addEventListener("click", (e) => {
            const activePanel = e.target.closest(".accordion__panel");
            if (!activePanel) return;
            toggleAccordion(activePanel);
        });
    });

    function toggleAccordion(panelToActivate) {
        const activeButton = panelToActivate.querySelector(".accordion__trigger");
        const activePanel = panelToActivate.querySelector(".accordion__content");
        const activePanelIsOpened = activeButton.getAttribute("aria-expanded");

        if (activePanelIsOpened === "true") {
            panelToActivate
            .querySelector(".accordion__trigger")
            .setAttribute("aria-expanded", false);

            panelToActivate
            .querySelector(".accordion__content")
            .setAttribute("aria-hidden", true);
        } else {
            panelToActivate.querySelector(".accordion__trigger").setAttribute("aria-expanded", true);

            panelToActivate
            .querySelector(".accordion__content")
            .setAttribute("aria-hidden", false);
        }
    }
}

export default newAccordion;