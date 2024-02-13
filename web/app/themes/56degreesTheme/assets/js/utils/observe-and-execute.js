module.exports = function observeAndExecute(selector, callback, disconnect = false) {
    const elementsToObserve = document.querySelectorAll(selector);
    if ( !elementsToObserve.length ) return;
    
    elementsToObserve.forEach(element => {
        const observer = new IntersectionObserver(entries => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    if ( disconnect ) {
                        observer.disconnect();
                    }
                    else {
                        observer.unobserve(element);
                    }

                    callback(element);
                }
            }
        });

        observer.observe(element);
    });
}