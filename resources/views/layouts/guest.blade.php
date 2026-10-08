<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <script>document.documentElement.classList.add('js');</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site_name', config('app.name')) }} — {{ setting('tagline', 'Digital Products Store') }}</title>

    @if (setting('favicon'))
        <link rel="icon" href="{{ media_url(setting('favicon')) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon.png') }}">
    @endif
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (setting('recaptcha_enabled') && setting('recaptcha_site_key'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="overflow-x-hidden bg-slate-50 text-slate-800 antialiased">
    @php $siteName = setting('site_name', config('app.name')); @endphp

    <div class="flex min-h-screen">
        <!-- Brand panel -->
        <aside class="relative hidden w-1/2 overflow-hidden bg-slate-900 lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-700 via-indigo-600 to-violet-700"></div>
            <div class="absolute -left-16 -top-16 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-80 w-80 translate-x-1/4 translate-y-1/4 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

            <div class="relative z-10 flex h-full flex-col justify-between p-12 text-white">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if (setting('logo'))
                        <img src="{{ media_url(setting('logo')) }}" alt="{{ $siteName }}" class="h-11 w-auto">
                    @else
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 text-lg font-extrabold ring-1 ring-white/20">
                            {{ strtoupper(substr($siteName, 0, 1)) }}
                        </span>
                        <span class="text-xl font-extrabold">{{ $siteName }}</span>
                    @endif
                </a>

                <div>
                    <h2 class="max-w-md text-4xl font-extrabold leading-tight">{{ setting('tagline', 'Premium digital products, delivered instantly.') }}</h2>
                    <p class="mt-4 max-w-md text-indigo-100">{{ setting('site_description', 'Buy, download and manage your digital subscriptions in one place.') }}</p>

                    <ul class="mt-10 space-y-4">
                        @foreach ([
                            ['icon' => 'bolt', 'text' => 'Instant digital delivery after payment'],
                            ['icon' => 'shield-check', 'text' => 'Secure checkout & trusted gateways'],
                            ['icon' => 'receipt', 'text' => 'Professional PDF invoices emailed'],
                        ] as $item)
                            <li class="flex items-center gap-3">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15 ring-1 ring-white/20">
                                    <x-ui-icon :name="$item['icon']" class="h-4 w-4" />
                                </span>
                                <span class="text-sm font-medium text-indigo-50">{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="text-xs text-indigo-200">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            </div>
        </aside>

        <!-- Form panel -->
        <main class="flex w-full items-center justify-center px-6 py-12 lg:w-1/2">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-8 flex items-center justify-center gap-2 lg:hidden">
                    @if (setting('logo'))
                        <img src="{{ media_url(setting('logo')) }}" alt="{{ $siteName }}" class="h-10 w-auto">
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-base font-extrabold text-white">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
                        <span class="text-lg font-extrabold text-slate-900">{{ $siteName }}</span>
                    @endif
                </a>

                <div class="rounded-3xl border border-slate-200 bg-white p-7 shadow-xl shadow-slate-200/70 sm:p-9">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-indigo-600">&larr; Back to store</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
