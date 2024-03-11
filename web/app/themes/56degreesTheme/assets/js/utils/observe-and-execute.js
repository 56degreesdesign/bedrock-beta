module.exports = function observeAndExecute(selector, callback, disconnect = false) {
    const elementsToObserve = document.querySelectorAll(selector);
    if ( !elementsToObserve.length ) return;
    
    const observer = new IntersectionObserver(entries => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                if ( disconnect ) {
                    observer.disconnect();
                }
                else {
                    observer.unobserve(entry.target);
                }

                callback(entry.target);
            }
        }
    });
    
    elementsToObserve.forEach(element => {
        observer.observe(element);
    });
}
