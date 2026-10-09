/**
 * EGX.lk storefront behaviours: mobile drawer, category accordion,
 * live search dropdown and back-to-top button.
 */
export function initEgxMenu() {
    const header = document.getElementById('egxHeader');
    const burger = document.getElementById('egxhMenuBtn');

    if (!header || !burger) {
        return;
    }

    burger.addEventListener('click', () => {
        const open = header.classList.toggle('drawer-open');
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.classList.toggle('egxh-menu-open', open);
    });

    document.querySelectorAll('[data-egxh-close]').forEach((el) => {
        el.addEventListener('click', () => {
            header.classList.remove('drawer-open');
            burger.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('egxh-menu-open');
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && header.classList.contains('drawer-open')) {
            header.classList.remove('drawer-open');
            burger.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('egxh-menu-open');
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 960 && header.classList.contains('drawer-open')) {
            header.classList.remove('drawer-open');
            burger.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('egxh-menu-open');
        }
    });

    // Accordion
    header.querySelectorAll('.egxh-dd-toggle').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const dd = toggle.parentElement;
            const open = dd.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });
}

export function initEgxLiveSearch(inputSelector, resultsSelector) {
    const input = document.querySelector(inputSelector);
    const results = document.querySelector(resultsSelector);

    if (!input || !results || typeof window.allProducts === 'undefined') {
        return;
    }

    const products = window.allProducts || [];

    const render = (items) => {
        if (items.length === 0 || input.value.trim() === '') {
            results.hidden = true;
            results.innerHTML = '';
            return;
        }

        results.innerHTML = items
            .slice(0, 8)
            .map(
                (p) => `<a class="ls-item" href="/products/${encodeURIComponent(p.slug)}">
                    <span class="ls-thumb">${p.image ? `<img src="${p.image}" alt="" loading="lazy">` : ''}</span>
                    <span class="ls-info">
                        <span class="ls-name">${escapeHtml(p.name)}</span>
                        <span class="ls-cat">${escapeHtml(p.category || 'Product')}</span>
                    </span>
                </a>`,
            )
            .join('') + `<a class="ls-all" href="/products?q=${encodeURIComponent(input.value)}">View all results →</a>`;

        results.hidden = false;
    };

    input.addEventListener('input', () => {
        const q = input.value.trim().toLowerCase();
        const matched = Array.isArray(products) ? products.filter((p) => p.name.toLowerCase().includes(q) || (p.category || '').toLowerCase().includes(q)) : [];
        render(q ? matched : []);
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.hidden = true;
        }
    });
}

export function initEgxToTop() {
    const btn = document.getElementById('egxToTop');

    if (!btn) {
        return;
    }

    const toggle = () => btn.classList.toggle('visible', window.scrollY > 600);

    toggle();
    window.addEventListener('scroll', toggle, { passive: true });

    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}