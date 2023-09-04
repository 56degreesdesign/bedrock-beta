module.exports = function () {
    const links = document.querySelectorAll('a[href*="#"]:not([href="#"]):not([href="#0"])'),
        header = document.querySelector(".header");

    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        let href = this.getAttribute("href");

        // Check in anchor is another page
        if ( href.includes('/#') ) {
            href = href.replace('/#', '#')
        }
        else {
            e.preventDefault();

            // Check is element on the page
            if ( document.querySelector(href) ) {
                let offsetTop = document.querySelector(href)?.getBoundingClientRect().top - window.pageYOffset;
                offsetTop = header ? ( offsetTop - header.getBoundingClientRect().height) : offsetTop;

                scroll({
                    top: offsetTop,
                    behavior: "smooth"
                });
            }
        }
    }
};