@extends('layouts.frontend')

@section('title', $product->name)
@section('meta_description', $product->short_description ?? $product->name)

@section('content')
    @php
        $image = $product->image ? media_url($product->image) : null;
        $variations = $product->variations->sortBy(fn ($v) => $v->billing_cycle === 'monthly' ? 0 : 1)->values();
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-10">
        <nav class="text-sm text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Products</a>
            @if ($product->category)
                <span class="mx-1">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
            @endif
        </nav>

        <div class="mt-6 grid gap-10 lg:grid-cols-2">
            <!-- Image -->
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white">
                <div class="aspect-[4/3] bg-gradient-to-br from-indigo-50 to-slate-100">
                    @if ($image)
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-indigo-300">
                            <x-ui-icon name="bag" class="h-20 w-20" />
                        </div>
                    @endif
                </div>
            </div>

            <!-- Details -->
            <div>
                <span class="text-sm font-bold uppercase tracking-wide text-indigo-600">{{ $product->category?->name }}</span>
                <h1 class="mt-2 text-3xl font-extrabold text-slate-900">{{ $product->name }}</h1>
                @if ($product->short_description)
                    <p class="mt-3 text-slate-600">{{ $product->short_description }}</p>
                @endif

                <div class="mt-6 flex flex-wrap gap-3 text-sm">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-700">
                        <x-ui-icon name="bolt" class="h-4 w-4" /> Instant delivery
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 font-semibold text-indigo-700">
                        <x-ui-icon name="shield-check" class="h-4 w-4" /> Secure checkout
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 font-semibold text-amber-700">
                        <x-ui-icon name="receipt" class="h-4 w-4" /> PDF invoice
                    </span>
                </div>

                <form x-data="{ selected: {{ $variations->first()?->id ?? 'null' }} }"
                      method="POST" action="{{ route('cart.store') }}" class="mt-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-500">Choose your plan</h3>

                    @if ($variations->isNotEmpty())
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            @foreach ($variations as $variation)
                                <label class="cursor-pointer">
                                    <input type="radio" name="variation_id" value="{{ $variation->id }}"
                                           class="peer sr-only" x-model.number="selected"
                                           @checked($loop->first)>
                                    <div class="rounded-2xl border-2 border-slate-200 p-4 transition peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:shadow-md">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-slate-900">{{ ucfirst($variation->billing_cycle) }}</span>
                                            <span class="text-xs font-semibold text-slate-400">{{ $variation->billing_cycle === 'monthly' ? 'Billed monthly' : 'Billed annually' }}</span>
                                        </div>
                                        <div class="mt-2 text-2xl font-extrabold text-indigo-600">{{ money($variation->price) }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @auth
                            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                                <button type="submit" formaction="{{ route('cart.store') }}"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-indigo-600 bg-white px-6 py-3.5 text-base font-bold text-indigo-600 transition hover:bg-indigo-50">
                                    <x-ui-icon name="cart" class="h-5 w-5" /> Add to Cart
                                </button>
                                <button type="submit" formaction="{{ route('cart.buy') }}"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-base font-bold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-700">
                                    <x-ui-icon name="bolt" class="h-5 w-5" /> Buy Now
                                </button>
                            </div>
                        @else
                            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('register', ['redirect' => url()->current()]) }}"
                                   class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-base font-bold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-700">
                                    <x-ui-icon name="bolt" class="h-5 w-5" /> Sign up &amp; Buy
                                </a>
                                <a href="{{ route('login', ['redirect' => url()->current()]) }}"
                                   class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-indigo-600 bg-white px-6 py-3.5 text-base font-bold text-indigo-600 transition hover:bg-indigo-50">
                                    <x-ui-icon name="lock" class="h-5 w-5" /> Login
                                </a>
                            </div>
                            <p class="mt-2 text-xs text-slate-400">
                                Sign up in seconds with Google — you'll return here to choose your plan and pay.
                            </p>
                        @endauth
                    @else
                        <p class="mt-3 rounded-xl bg-slate-100 p-4 text-sm text-slate-500">Pricing for this product is coming soon. Please contact us for details.</p>
                    @endif
                </form>
            </div>
        </div>

        <!-- Description -->
        <div class="mt-14 grid gap-8 lg:grid-cols-[1fr_320px]">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 md:p-8">
                <h2 class="text-xl font-extrabold text-slate-900">Product Description</h2>
                <div class="prose prose-slate mt-4 max-w-none">
                    {!! $product->description ?: '<p class="text-slate-500">No description provided.</p>' !!}
                </div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h3 class="font-bold text-slate-900">What you get</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        @foreach (['Digital delivery — no shipping', 'Access details in your dashboard', 'Professional PDF invoice', 'Email confirmation & receipt'] as $line)
                            <li class="flex items-start gap-2">
                                <x-ui-icon name="check-circle" class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500" />
                                <span>{{ $line }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (setting('whatsapp_number'))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}"
                       target="_blank" rel="noopener"
                       class="flex items-center justify-center gap-2 rounded-3xl border border-emerald-200 bg-emerald-50 p-5 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100">
                        <x-ui-icon name="phone" class="h-4 w-4" /> Need help? Chat on WhatsApp
                    </a>
                @endif
            </aside>
        </div>

        <!-- Related -->
        @if ($related->isNotEmpty())
            <section class="mt-16">
                <h2 class="mb-6 text-2xl font-extrabold text-slate-900">You may also like</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
