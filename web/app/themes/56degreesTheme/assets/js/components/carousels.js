const carousels = async function () {
    const exampleCarousel = [...document.querySelectorAll(".example-carousel")];

    if (exampleCarousel) {
        const Swiper = await (await import("swiper/bundle")).default;

        if (exampleCarousel) {
            exampleCarousel.forEach(section => {
                const carousel = new Swiper(section.querySelector(".swiper"), {
                    slidesPerView: 1,
                    spaceBetween: 20,
                })
            })
        }
    }
}

export const init = carousels;