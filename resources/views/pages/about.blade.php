@extends('layouts.frontend')

@section('title', setting('meta_about_title') ?: 'About Us')
@section('meta_description', setting('meta_about_description'))
@section('canonical', route('about'))

@section('content')
    <section class="relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 via-indigo-600 to-violet-600 opacity-90"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-20 text-center">
            <h1 class="text-4xl font-extrabold text-white md:text-5xl">About {{ setting('site_name', config('app.name')) }}</h1>
            <p class="mx-auto mt-4 max-w-2xl text-indigo-100">
                {{ setting('tagline', 'Delivering premium digital products to customers across the globe.') }}
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
            <div data-reveal="left">
                <span class="text-sm font-bold uppercase tracking-wider text-indigo-600">Our Story</span>
                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">Digital products made simple</h2>
                <div class="prose prose-slate mt-4 max-w-none text-slate-600">
                    <p>
                        {{ setting('site_name', config('app.name')) }} is your trusted destination for premium digital products and
                        subscriptions. We make it easy to discover, purchase and instantly access the tools and services you need —
                        without the wait, paperwork or shipping.
                    </p>
                    <p>
                        From the moment you place an order, everything is automated: secure payment, instant digital delivery,
                        and a professional invoice delivered straight to your inbox. Our team is always a message away should you
                        need a hand.
                    </p>
                </div>

                <div class="mt-8 grid grid-cols-3 gap-4">
                    @foreach ([
                        ['value' => '100%', 'label' => 'Digital delivery'],
                        ['value' => '24/7', 'label' => 'Customer support'],
                        ['value' => 'Secure', 'label' => 'Trusted payments'],
                    ] as $stat)
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center">
                            <div class="text-2xl font-extrabold text-indigo-600">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-xs font-medium text-slate-500">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2" data-reveal="right">
                @foreach ([
                    ['icon' => 'bolt', 'title' => 'Instant Access', 'text' => 'Your products are unlocked the moment your payment is confirmed.'],
                    ['icon' => 'shield-check', 'title' => 'Secure & Safe', 'text' => 'Payments are processed through trusted, PCI-compliant gateways.'],
                    ['icon' => 'globe', 'title' => 'Global Reach', 'text' => 'Purchase from anywhere and access your products worldwide.'],
                    ['icon' => 'receipt', 'title' => 'Professional Invoices', 'text' => 'Every order includes a downloadable PDF invoice.'],
                ] as $card)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:shadow-lg">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <x-ui-icon :name="$card['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-4 font-bold text-slate-900">{{ $card['title'] }}</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ $card['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($categories->isNotEmpty())
        <section class="border-t border-slate-200 bg-white py-16">
            <div class="mx-auto max-w-7xl px-4 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900">What we offer</h2>
                <p class="mx-auto mt-2 max-w-xl text-slate-500">Explore our curated categories of digital products.</p>
                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="rounded-full border border-slate-200 bg-slate-50 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
