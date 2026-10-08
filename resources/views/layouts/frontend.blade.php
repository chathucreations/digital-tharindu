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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (setting('recaptcha_enabled') && setting('recaptcha_site_key') && request()->routeIs('contact'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="overflow-x-hidden bg-slate-50 text-slate-800 antialiased">

@php
    $cartCount = count(session('cart', []));
    $navLinks = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Products', 'route' => 'products.index'],
        ['label' => 'About Us', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<!-- Top bar -->
<div class="hidden bg-slate-900 text-slate-300 md:block">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 text-xs">
        <div class="flex items-center gap-6">
            @if (setting('contact_phone'))
                <span class="flex items-center gap-1.5">
                    <x-ui-icon name="phone" class="h-3.5 w-3.5" /> {{ setting('contact_phone') }}
                </span>
            @endif
            @if (setting('contact_email'))
                <span class="flex items-center gap-1.5">
                    <x-ui-icon name="envelope" class="h-3.5 w-3.5" /> {{ setting('contact_email') }}
                </span>
            @endif
        </div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('customer.dashboard') }}" class="hover:text-white">My Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-white">Login</a>
                <a href="{{ route('register') }}" class="hover:text-white">Register</a>
            @endauth
        </div>
    </div>
</div>

<!-- Header -->
<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            @if (setting('logo'))
                <img src="{{ media_url(setting('logo')) }}" alt="{{ setting('site_name') }}" class="h-10 w-auto">
            @else
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-bold text-white">
                    {{ strtoupper(substr(setting('site_name', 'DS'), 0, 1)) }}
                </span>
                <span class="text-xl font-extrabold text-slate-900">{{ setting('site_name', config('app.name')) }}</span>
            @endif
        </a>

        <nav class="hidden items-center gap-1 lg:flex">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="rounded-lg px-4 py-2 text-sm font-semibold transition {{ request()->routeIs($link['route']) ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('cart.index') }}" class="relative rounded-lg p-2.5 text-slate-600 hover:bg-slate-100" aria-label="Cart">
                <x-ui-icon name="cart" class="h-6 w-6" />
                @if ($cartCount > 0)
                    <span class="absolute -right-0.5 -top-0.5 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-[11px] font-bold text-white">{{ $cartCount }}</span>
                @endif
            </a>

            @auth
                <a href="{{ route('customer.dashboard') }}" class="hidden rounded-lg p-2.5 text-slate-600 hover:bg-slate-100 sm:block" aria-label="Account">
                    <x-ui-icon name="user" class="h-6 w-6" />
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 sm:block">
                    Sign In
                </a>
            @endauth

            <button type="button" @click="open = ! open" class="rounded-lg p-2.5 text-slate-600 hover:bg-slate-100 lg:hidden" aria-label="Menu">
                <x-ui-icon name="menu" class="h-6 w-6" />
            </button>
        </div>
    </div>

    <!-- Mobile nav -->
    <div x-show="open" x-cloak class="border-t border-slate-200 bg-white lg:hidden">
        <div class="space-y-1 px-4 py-3">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold {{ request()->routeIs($link['route']) ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            @guest
                <a href="{{ route('login') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100">Login</a>
                <a href="{{ route('register') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100">Register</a>
            @endguest
        </div>
    </div>
</header>

@if (session('status'))
    <div class="mx-auto mt-4 max-w-7xl px-4">
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ session('status') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="mx-auto mt-4 max-w-7xl px-4">
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">
            {{ session('error') }}
        </div>
    </div>
@endif

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="mt-20 bg-slate-900 text-slate-400">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 md:grid-cols-4">
        <div class="md:col-span-1">
            <div class="text-xl font-extrabold text-white">{{ setting('site_name', config('app.name')) }}</div>
            <p class="mt-3 text-sm leading-relaxed">{{ setting('site_description', 'Your one-stop destination for premium digital products and subscriptions.') }}</p>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Shop</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('products.index') }}" class="hover:text-white">All Products</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Account</h4>
            <ul class="space-y-2 text-sm">
                @auth
                    <li><a href="{{ route('customer.dashboard') }}" class="hover:text-white">My Dashboard</a></li>
                    <li><a href="{{ route('customer.orders.index') }}" class="hover:text-white">My Orders</a></li>
                    <li><a href="{{ route('customer.products') }}" class="hover:text-white">My Products</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white">Register</a></li>
                @endauth
            </ul>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Get in Touch</h4>
            <ul class="space-y-3 text-sm">
                @if (setting('contact_address'))
                    <li class="flex gap-2"><x-ui-icon name="map" class="mt-0.5 h-4 w-4 shrink-0" /> {{ setting('contact_address') }}</li>
                @endif
                @if (setting('contact_phone'))
                    <li class="flex gap-2"><x-ui-icon name="phone" class="h-4 w-4 shrink-0" /> {{ setting('contact_phone') }}</li>
                @endif
                @if (setting('contact_email'))
                    <li class="flex gap-2"><x-ui-icon name="envelope" class="h-4 w-4 shrink-0" /> {{ setting('contact_email') }}</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="border-t border-slate-800 py-5 text-center text-xs">
        &copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. All rights reserved.
    </div>
</footer>

<!-- Back to top -->
<div x-data="{ show: false }" @scroll.window.throttle.200ms="show = window.scrollY > 600"
     class="fixed bottom-24 right-6 z-40">
    <button x-show="show" x-transition.opacity
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-900 text-white shadow-lg shadow-slate-900/30 transition hover:bg-slate-700"
            aria-label="Back to top">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0-6 6m6-6 6 6" />
        </svg>
    </button>
</div>

<!-- Floating WhatsApp button -->
@if (setting('whatsapp_number'))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}?text={{ urlencode('Hello, I would like to know more about your products.') }}"
       target="_blank" rel="noopener"
       class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg shadow-green-500/40 transition hover:scale-105"
       aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" class="h-7 w-7 fill-current" aria-hidden="true">
            <path d="M16.001 3C8.82 3 3 8.82 3 16c0 2.29.6 4.44 1.65 6.3L3 29l6.88-1.8A12.94 12.94 0 0 0 16 29c7.18 0 13-5.82 13-13S23.18 3 16.001 3Zm0 23.5c-2.02 0-3.9-.55-5.5-1.5l-.39-.23-4.08 1.07 1.09-3.98-.25-.41A10.44 10.44 0 0 1 5.5 16c0-5.79 4.71-10.5 10.5-10.5S26.5 10.21 26.5 16 21.79 26.5 16 26.5Zm5.76-7.86c-.31-.16-1.86-.92-2.15-1.02-.29-.11-.5-.16-.71.16-.21.31-.82 1.02-1 1.23-.18.21-.37.24-.68.08-.31-.16-1.33-.49-2.53-1.56-.94-.83-1.57-1.86-1.75-2.17-.18-.31-.02-.48.14-.64.14-.14.31-.37.47-.55.16-.18.21-.31.31-.52.11-.21.05-.39-.02-.55-.08-.16-.71-1.71-.97-2.34-.26-.62-.52-.54-.71-.55l-.61-.01c-.21 0-.55.08-.84.39-.29.31-1.1 1.08-1.1 2.63s1.13 3.05 1.29 3.26c.16.21 2.23 3.4 5.4 4.77.75.32 1.34.52 1.8.66.76.24 1.45.21 2 .13.61-.09 1.86-.76 2.13-1.5.26-.73.26-1.36.18-1.5-.08-.13-.29-.21-.6-.37Z"/>
        </svg>
    </a>
@endif

@stack('scripts')
</body>
</html>
