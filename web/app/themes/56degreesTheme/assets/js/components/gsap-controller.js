const gsapController = async function () {
    const exampleElement = document.querySelector(".example") !== null;
    
    if ( exampleElement  ) {
        let gsap = await (await import('gsap')).default;

        // ScrollTrigger
        if ( exampleElement ) {
            let ScrollTrigger = await (await import('gsap/ScrollTrigger')).default;
            gsap.registerPlugin(ScrollTrigger);

            if ( exampleElement ) {
                let AnimatedSection = await (await import('./gsap/example')).default;
                AnimatedSection(gsap, ScrollTrigger);
            }
        }
    }
};

export const init = gsapController;