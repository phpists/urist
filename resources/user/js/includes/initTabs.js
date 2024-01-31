import Tabs from "./tabs.js";

const initTabs = () => {
    const tabsAll = document.querySelectorAll("[data-tabs]");

    tabsAll?.forEach(item => {
        const tabID = item.getAttribute("data-tabs");

        new Tabs(tabID, {
            active: 0,
            transition: 300,
        });
    });
}

export default initTabs;
