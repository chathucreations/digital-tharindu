import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * Reveal-on-scroll: adds the `is-revealed` class to [data-reveal] elements
 * when they enter the viewport. An optional `data-reveal-delay` (ms) staggers
 * the animation.
 */
function initScrollReveal() {
    const elements = document.querySelectorAll('[data-reveal]');

    if (elements.length === 0) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        elements.forEach((el) => el.classList.add('is-revealed'));

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const el = entry.target;
                const delay = parseInt(el.getAttribute('data-reveal-delay') || '0', 10);

                if (delay > 0) {
                    el.style.transitionDelay = `${delay}ms`;
                }

                el.classList.add('is-revealed');
                observer.unobserve(el);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' },
    );

    elements.forEach((el) => observer.observe(el));
}

if (document.readyState !== 'loading') {
    initScrollReveal();
} else {
    document.addEventListener('DOMContentLoaded', initScrollReveal);
}
