export default function observeAndExecute(selectorOrElements, options = {
    callback: false,
    disconnect: false,
    observerOptions: {}
}) {
    let elementsToObserve;

    if (typeof selectorOrElements === 'string') {
        elementsToObserve = Array.from(document.querySelectorAll(selectorOrElements));
    } else if (selectorOrElements instanceof Element) {
        elementsToObserve = [selectorOrElements];
    } else {
        elementsToObserve = selectorOrElements;
    }

    if (!elementsToObserve.length) return;

    const observer = new IntersectionObserver(entries => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                if (options.disconnect) {
                    observer.disconnect();
                } else {
                    observer.unobserve(entry.target);
                }

                if (options.callback) {
                    options.callback(entry.target);
                }
            }
        }
    }, options.observerOptions);

    elementsToObserve.forEach(element => {
        observer.observe(element);
    });
}