module.exports = function ($) {
    const links = document.querySelectorAll('a[href*="#"]:not([href="#"]):not([href="#0"])'),
        header = document.querySelector(".header");

    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        let href = this.getAttribute("href");

        // Check in anchor is another page
        if ( href.includes('/#') ) {
            if ( href.split("#")[0] === window.location.href.split("#")[0] ) {
                e.preventDefault();
                moveTo(href.slice(href.indexOf("#")));
            }
        }
        else {
            e.preventDefault();
            moveTo(href);
        }
    }

    function moveTo(href) {
        if ( document.querySelector(href) ) {
            const element = document.querySelector(href);
            let offsetTop = element.getBoundingClientRect().top + window.scrollY;
            // offsetTop = header ? ( offsetTop - header.getBoundingClientRect().height) : offsetTop;

            scrollTo({top: offsetTop, behavior: "smooth"});
        }
    }
};
