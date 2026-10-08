@extends('layouts.frontend')

@section('title', setting('site_name', config('app.name')))
@section('meta_title', setting('meta_home_title'))
@section('meta_description', setting('meta_home_description'))

@section('content')
    <!-- Hero / Slider -->
    @if ($sliders->isNotEmpty())
        <section
            x-data="{
                active: 0,
                count: {{ $sliders->count() }},
                init() { if (this.count > 1) setInterval(() => this.active = (this.active + 1) % this.count, 6000) }
            }"
            class="relative h-[420px] overflow-hidden bg-slate-900 md:h-[540px]">
            @foreach ($sliders as $index => $slider)
                <div x-show="active === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-500 absolute inset-0"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <img src="{{ media_url($slider->image) }}"
                         alt="{{ $slider->title }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/60 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center">
                        <div class="mx-auto w-full max-w-7xl px-6">
                            <div class="max-w-2xl animate-fade-up">
                                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-indigo-200 ring-1 ring-white/20">
                                    <x-ui-icon name="sparkles" class="h-3.5 w-3.5" /> Premium Digital Products
                                </span>
                                <h1 class="mt-4 text-3xl font-extrabold leading-tight text-white md:text-5xl">{{ $slider->title }}</h1>
                                @if ($slider->subtitle)
                                    <p class="mt-4 max-w-xl text-base text-slate-200 md:text-lg">{{ $slider->subtitle }}</p>
                                @endif
                                <div class="mt-8 flex flex-wrap gap-3">
                                    <a href="{{ $slider->link ?: route('products.index') }}"
                                       class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-500">
                                        {{ $slider->button_text ?: 'Shop Now' }}
                                        <x-ui-icon name="arrow-right" class="h-4 w-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($sliders->count() > 1)
                <div class="absolute bottom-6 left-1/2 z-10 flex -translate-x-1/2 gap-2">
                    @foreach ($sliders as $index => $slider)
                        <button @click="active = {{ $index }}"
                                :class="active === {{ $index }} ? 'w-8 bg-white' : 'w-2.5 bg-white/50'"
                                class="h-2.5 rounded-full transition-all duration-300" aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        <section class="relative overflow-hidden bg-slate-900">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 via-indigo-600 to-violet-600 opacity-90"></div>
            <div class="relative mx-auto max-w-7xl px-6 py-24 text-center animate-fade-up">
                <h1 class="text-4xl font-extrabold text-white md:text-5xl">{{ setting('tagline', 'Premium Digital Products, Delivered Instantly') }}</h1>
                <p class="mx-auto mt-4 max-w-2xl text-indigo-100">{{ setting('site_description', 'Buy, download and manage your digital subscriptions in one place.') }}</p>
                <a href="{{ route('products.index') }}" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50">
                    Browse Products <x-ui-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </section>
    @endif

    <!-- Value props -->
    <section class="relative z-20 mx-auto -mt-10 max-w-7xl px-4">
        <div data-reveal class="grid gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-200/60 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['icon' => 'bolt', 'title' => 'Instant Delivery', 'text' => 'Get access immediately after payment.'],
                ['icon' => 'shield-check', 'title' => 'Secure Payments', 'text' => 'Protected by trusted gateways.'],
                ['icon' => 'globe', 'title' => 'Global Access', 'text' => 'Access your products anywhere.'],
                ['icon' => 'receipt', 'title' => 'Invoices Included', 'text' => 'Professional PDF invoices emailed.'],
            ] as $item)
                <div class="flex items-start gap-3">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <x-ui-icon :name="$item['icon']" class="h-6 w-6" />
                    </span>
                    <div>
                        <div class="font-bold text-slate-900">{{ $item['title'] }}</div>
                        <div class="text-sm text-slate-500">{{ $item['text'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Featured products -->
    @if ($featured->isNotEmpty())
        <section class="mx-auto mt-20 max-w-7xl px-4">
            <div data-reveal class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-sm font-bold uppercase tracking-wider text-indigo-600">Handpicked</span>
                    <h2 class="mt-1 text-3xl font-extrabold text-slate-900">{{ setting('featured_title', 'Featured Products') }}</h2>
                    @if (setting('featured_subtitle'))
                        <p class="mt-1 text-slate-500">{{ setting('featured_subtitle') }}</p>
                    @endif
                </div>
                <a href="{{ route('products.index') }}" class="hidden items-center gap-1 text-sm font-bold text-indigo-600 hover:text-indigo-700 sm:flex">
                    View all <x-ui-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($featured as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    <!-- Full-width promo banners -->
    @foreach ($banners as $banner)
        @php
            $align = match ($banner->alignment) {
                'left' => 'items-start text-left',
                'right' => 'items-end text-right',
                default => 'items-center text-center',
            };
            $justify = match ($banner->alignment) {
                'left' => 'mr-auto',
                'right' => 'ml-auto',
                default => 'mx-auto',
            };
        @endphp
        <section class="relative mt-20 w-full overflow-hidden">
            @if ($banner->image)
                <img src="{{ media_url($banner->image) }}" alt="{{ $banner->title }}" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-slate-900/65"></div>
            @else
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-violet-700"></div>
            @endif

            <div class="relative mx-auto w-full max-w-7xl px-6 py-16 md:py-20">
                <div data-reveal="scale" class="flex flex-col {{ $align }}">
                    <div class="max-w-2xl {{ $justify }}">
                        <h2 class="text-2xl font-extrabold leading-tight text-white sm:text-3xl md:text-4xl">{{ $banner->title }}</h2>
                        @if ($banner->subtitle)
                            <p class="mt-3 text-sm text-white/90 sm:text-base md:text-lg">{{ $banner->subtitle }}</p>
                        @endif
                        @if ($banner->link)
                            <a href="{{ $banner->link }}"
                               class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50">
                                {{ $banner->button_text ?: 'Learn More' }}
                                <x-ui-icon name="arrow-right" class="h-4 w-4" />
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <!-- Category sections -->
    @foreach ($categories as $category)
        <section class="mx-auto mt-20 max-w-7xl px-4">
            <div data-reveal class="mb-8 flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900">{{ $category->name }}</h2>
                    @if ($category->description)
                        <p class="mt-1 max-w-2xl text-slate-500">{{ $category->description }}</p>
                    @endif
                </div>
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="hidden items-center gap-1 text-sm font-bold text-indigo-600 hover:text-indigo-700 sm:flex">
                    Explore <x-ui-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($category->products->take(4) as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endforeach

    <!-- CTA -->
    <section class="mx-auto mt-20 max-w-7xl px-4">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-700 to-violet-700 px-8 py-14 text-center" data-reveal="scale">
            <div class="relative">
                <h2 class="text-3xl font-extrabold text-white">Ready to get started?</h2>
                <p class="mx-auto mt-3 max-w-xl text-indigo-100">Create your account and unlock instant access to all our premium digital products.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50">Create Account</a>
                    <a href="{{ route('products.index') }}" class="rounded-xl border border-white/40 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">Browse Products</a>
                </div>
            </div>
        </div>
    </section>
@endsection
