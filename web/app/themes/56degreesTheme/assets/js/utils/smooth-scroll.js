module.exports = function () {
    const links = document.querySelectorAll('a[href*="#"]:not([href="#"]):not([href="#0"])'),
        header = document.querySelector(".header");

    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        let href = this.getAttribute("href");
        
        try {
            const url = new URL(href, window.location.href);
            const siteUrl = window.location;

            if ( siteUrl.origin === url.origin && siteUrl.pathname === url.pathname ) {
                e.preventDefault();
                moveTo(url.hash);
            }
        } catch (e) {}
    }

    function moveTo(hash) {
        if ( document.querySelector(hash) ) {
            const element = document.querySelector(hash);
            let offsetTop = element.getBoundingClientRect().top + window.scrollY;
            // offsetTop = header ? ( offsetTop - header.getBoundingClientRect().height) : offsetTop;

            scrollTo({top: offsetTop, behavior: "smooth"});
        }
    }
};
