// App entry

// Flux initialization watcher: if Flux runtime never initializes, add a fallback
// class so CSS can hide mobile-only header elements on desktop to avoid layout shift.
document.addEventListener('DOMContentLoaded', () => {
    if (!window.Flux) {
        document.documentElement.classList.add('flux-not-initialized');
    }

    // Poll briefly in case Flux loads slightly later (e.g., dynamic navigation)
    let attempts = 0;
    const checkFlux = setInterval(() => {
        if (window.Flux) {
            document.documentElement.classList.remove('flux-not-initialized');
            clearInterval(checkFlux);
            return;
        }
        attempts++;
        if (attempts > 20) clearInterval(checkFlux);
    }, 200);
});
