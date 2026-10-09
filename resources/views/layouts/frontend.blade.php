<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <script>document.documentElement.classList.add('js');</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = setting('site_name', config('app.name'));
        $metaTitle = trim($__env->yieldContent('meta_title')) ?: (trim($__env->yieldContent('title')) ?: $siteName);
        $fullTitle = $metaTitle === $siteName ? $siteName : $metaTitle . ' — ' . $siteName;
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: setting('default_meta_description', setting('site_description', ''));
        $metaKeywords = trim($__env->yieldContent('meta_keywords')) ?: setting('default_meta_keywords', '');
        $ogImage = trim($__env->yieldContent('og_image')) ?: media_url(setting('default_og_image'));
        $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();

        $categories = \App\Models\Category::query()->where('is_active', true)->orderBy('sort_order')->get();
        $cartCount = count(session('cart', []));
        $phone = setting('contact_phone');
        $phoneHref = $phone ? preg_replace('/[^0-9]/', '', (string) $phone) : null;
        $whatsapp = setting('whatsapp_number');
        $whatsappHref = $whatsapp ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', (string) $whatsapp) : null;
        $allProductsJson = \App\Models\Product::query()
            ->where('is_active', true)
            ->get(['name', 'slug', 'category_id', 'image'])
            ->map(fn ($p) => [
                'name' => $p->name,
                'slug' => $p->slug,
                'category' => $p->category?->name,
                'image' => $p->image ? media_url($p->image) : null,
            ])->values()->toJson();
    @endphp

    <title>{{ $fullTitle }}</title>
    @if ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if ($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:url" content="{{ $canonical }}">
    @if ($metaDescription)
        <meta property="og:description" content="{{ $metaDescription }}">
    @endif
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif

    <meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    @if ($metaDescription)
        <meta name="twitter:description" content="{{ $metaDescription }}">
    @endif
    @if ($ogImage)
        <meta name="twitter:image" content="{{ $ogImage }}">
    @endif

    @if (setting('favicon'))
        <link rel="icon" href="{{ media_url(setting('favicon')) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (setting('recaptcha_enabled') && setting('recaptcha_site_key') && request()->routeIs('contact'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    {{-- All product data for the live search dropdown --}}
    <script>window.allProducts = {!! $allProductsJson !!};</script>
</head>
<body class="egxh-page">

{{-- ===================================================================== --}}
{{-- HEADER (3-row: utility / logo+search+actions / navy categories)      --}}
{{-- ===================================================================== --}}
<header class="egxh" id="egxHeader">

    {{-- ROW 1 : utility bar --}}
    <div class="egxh-util">
        <div class="egxh-wrap">
            @if ($phone)
                <a class="egxh-phone" href="tel:{{ $phoneHref }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    +{{ preg_replace('/^0/', '', (string) $phone) }}
                </a>
            @endif
            <div class="egxh-util-right">
                <ul class="egxh-util-links">
                    <li><a href="{{ route('customer.dashboard') }}">My Account</a></li>
                    <li><a href="{{ $whatsappHref ?? '#' }}" target="_blank" rel="noopener">Agent Support</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ROW 2 : logo / search / deals / account / cart --}}
    <div class="egxh-main">
        <div class="egxh-wrap">
            <button type="button" class="egxh-icon-btn egxh-burger" id="egxhMenuBtn" aria-label="Open menu" aria-expanded="false" aria-controls="egxhDrawer">
                <svg class="egxh-bars" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
                <svg class="egxh-x" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>

            <a class="egxh-logo" href="{{ route('home') }}">
                @if (setting('logo'))
                    <img class="logo-img" src="{{ media_url(setting('logo')) }}" alt="{{ $siteName }}">
                @else
                    <span class="logo-mark">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
                    <span class="egxh-logo-text">{{ $siteName }}</span>
                @endif
            </a>

            <div class="egxh-search">
                <form class="search-form egxh-search-box" method="GET" action="{{ route('products.index') }}" role="search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" name="q" id="searchInput" placeholder="Search Products" autocomplete="off">
                    <button type="submit" aria-label="Search">Search</button>
                </form>
                <div class="live-search-results" id="liveSearchResults" hidden></div>
            </div>

            <a class="egxh-deals" href="{{ route('products.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2c1 3.5-2 5-2 7a2 2 0 1 0 4 0c0-1.5-.5-2.5-1-3.8.5 1 1.5 1.8 2.8 2.3A5 5 0 1 1 7 12c0-4 3-5 5-10z"/></svg>
                <div>
                    <div class="egxh-deals-title">Instant <span>Delivery</span></div>
                    <div class="egxh-deals-sub"><b>Digital</b> Products</div>
                </div>
            </a>

            @auth
                <a class="egxh-acc" href="{{ route('customer.dashboard') }}" aria-label="Dashboard">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="egxh-acc-text"><span class="egxh-acc-big">My Account</span><span class="egxh-acc-small">Dashboard</span></span>
                </a>
            @else
                <a class="egxh-acc" href="{{ route('login') }}" aria-label="Sign in">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="egxh-acc-text"><span class="egxh-acc-big">Sign in</span><span class="egxh-acc-small">Account</span></span>
                </a>
            @endauth

            <a class="egxh-cart" href="{{ route('cart.index') }}" aria-label="Cart">
                <span class="egxh-cart-ico">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <span class="egxh-cart-badge cart-badge">{{ $cartCount }}</span>
                </span>
                <span class="egxh-cart-text">My Cart</span>
            </a>
        </div>
    </div>

    {{-- Mobile search row --}}
    <div class="egxh-msearch">
        <form class="search-form egxh-search-box" method="GET" action="{{ route('products.index') }}" role="search">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="q" id="mobileSearchInput" placeholder="Search Products" autocomplete="off">
            <button type="submit" aria-label="Search">Search</button>
        </form>
        <div class="live-search-results" id="mobileLiveSearchResults" hidden></div>
    </div>

    {{-- ROW 3 : navy category bar --}}
    <nav class="egxh-cats" aria-label="Product categories">
        <div class="egxh-wrap">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="{{ request('category') === $category->slug ? 'is-active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') && ! request('category') ? 'is-active' : '' }}">
                More Products
            </a>
        </div>
    </nav>

    {{-- Mobile drawer --}}
    <div class="egxh-drawer-bg" data-egxh-close></div>
    <nav class="egxh-drawer" id="egxhDrawer" aria-label="Mobile menu">
        <div class="egxh-dd">
            <button type="button" class="egxh-dd-toggle" aria-expanded="false">All Products<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></button>
            <div class="egxh-dd-list">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                @endforeach
                <a href="{{ route('products.index') }}">More Products</a>
            </div>
        </div>
        @auth
            <a href="{{ route('customer.dashboard') }}">My Dashboard</a>
            <a href="{{ route('customer.orders.index') }}">My Orders</a>
            <a href="{{ route('customer.products') }}">My Products</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="egxh-dd-link-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Sign in</a>
            <a href="{{ route('register') }}">Create account</a>
        @endauth
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
        @if ($phone)
            <a class="egxh-dd-call" href="tel:{{ $phoneHref }}">Call {{ $phone }}</a>
        @endif
    </nav>
</header>

{{-- ===================================================================== --}}
{{-- Flash messages                                                       --}}
{{-- ===================================================================== --}}
@if (session('status'))
    <div class="egx-flash egx-flash-ok">
        <span>{{ session('status') }}</span>
        <button type="button" onclick="this.parentElement.remove()" aria-label="Dismiss">&times;</button>
    </div>
@endif
@if (session('error'))
    <div class="egx-flash egx-flash-err">
        <span>{{ session('error') }}</span>
        <button type="button" onclick="this.parentElement.remove()" aria-label="Dismiss">&times;</button>
    </div>
@endif

<main>
    @yield('content')
</main>

{{-- ===================================================================== --}}
{{-- FOOTER                                                               --}}
{{-- ===================================================================== --}}
<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                @if (setting('logo'))
                    <img class="footer-logo" src="{{ media_url(setting('logo')) }}" alt="{{ $siteName }}">
                @else
                    <div class="footer-logo-text">{{ $siteName }}</div>
                @endif
                <p>{{ setting('site_description', 'Premium digital products and subscriptions, delivered instantly.') }}</p>
                @if ($phone)
                    <div class="footer-hotline">
                        <div class="fh-label">Hotline</div>
                        <a href="tel:{{ $phoneHref }}">{{ $phone }}</a>
                    </div>
                @endif
            </div>

            <div class="footer-col">
                <h4>Quick Actions</h4>
                <a class="footer-action-btn" href="{{ route('products.index') }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>Browse Products</a>
                <a class="footer-action-btn" href="{{ route('customer.dashboard') }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>My Account</a>
                @if ($whatsappHref)
                    <a class="footer-action-btn" href="{{ $whatsappHref }}" target="_blank" rel="noopener"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>Technical Support</a>
                @endif
                <a class="footer-action-btn" href="{{ $whatsappHref ?? '#' }}" target="_blank" rel="noopener"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>Track your Order</a>
            </div>

            <div class="footer-col">
                <h4>Products</h4>
                <ul>
                    @foreach ($categories->take(5) as $category)
                        <li><a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                    <li><a href="{{ route('products.index') }}">View All Products</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    @if ($phone)
                        <li><a href="tel:{{ $phoneHref }}">{{ $phone }}</a></li>
                    @endif
                    @if (setting('contact_email'))
                        <li><a href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a></li>
                    @endif
                    @if ($whatsappHref)
                        <li><a href="{{ $whatsappHref }}" target="_blank" rel="noopener">WhatsApp Support</a></li>
                    @endif
                    <li><a href="{{ route('products.index') }}">How to Order</a></li>
                    <li><a href="{{ route('contact') }}">FAQs</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                    <li><a href="{{ route('contact') }}">Discount Offers</a></li>
                    <li><a href="{{ route('products.index') }}">New Products</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $siteName }}{{ setting('tagline') ? ' · ' . setting('tagline') : '' }}</span>
            <div>
                <a href="{{ route('contact') }}">Privacy</a>
                <a href="{{ route('contact') }}">Terms</a>
                <a href="{{ route('contact') }}">Refunds</a>
            </div>
        </div>
    </div>
</footer>

{{-- WhatsApp float --}}
@if ($whatsappHref)
    <a class="egx-wa-float" href="{{ $whatsappHref }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" class="h-7 w-7 fill-current" aria-hidden="true">
            <path d="M16.001 3C8.82 3 3 8.82 3 16c0 2.29.6 4.44 1.65 6.3L3 29l6.88-1.8A12.94 12.94 0 0 0 16 29c7.18 0 13-5.82 13-13S23.18 3 16.001 3Zm0 23.5c-2.02 0-3.9-.55-5.5-1.5l-.39-.23-4.08 1.07 1.09-3.98-.25-.41A10.44 10.44 0 0 1 5.5 16c0-5.79 4.71-10.5 10.5-10.5S26.5 10.21 26.5 16 21.79 26.5 16 26.5Zm5.76-7.86c-.31-.16-1.86-.92-2.15-1.02-.29-.11-.5-.16-.71.16-.21.31-.82 1.02-1 1.23-.18.21-.37.24-.68.08-.31-.16-1.33-.49-2.53-1.56-.94-.83-1.57-1.86-1.75-2.17-.18-.31-.02-.48.14-.64.14-.14.31-.37.47-.55.16-.18.21-.31.31-.52.11-.21.05-.39-.02-.55-.08-.16-.71-1.71-.97-2.34-.26-.62-.52-.54-.71-.55l-.61-.01c-.21 0-.55.08-.84.39-.29.31-1.1 1.08-1.1 2.63s1.13 3.05 1.29 3.26c.16.21 2.23 3.4 5.4 4.77.75.32 1.34.52 1.8.66.76.24 1.45.21 2 .13.61-.09 1.86-.76 2.13-1.5.26-.73.26-1.36.18-1.5-.08-.13-.29-.21-.6-.37Z"/>
        </svg>
    </a>
@endif

{{-- Back to top --}}
<button type="button" class="egx-to-top" id="egxToTop" aria-label="Back to top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
</button>

@stack('scripts')
</body>
</html>