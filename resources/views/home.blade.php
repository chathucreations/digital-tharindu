@extends('layouts.frontend')

@section('title', setting('site_name', config('app.name')))
@section('meta_title', setting('meta_home_title'))
@section('meta_description', setting('meta_home_description'))

@section('content')
    {{-- ================================================================= --}}
    {{-- Top banner slider (EGX .egxb carousel)                            --}}
    {{-- ================================================================= --}}
    @if ($sliders->isNotEmpty())
        <section class="egxb" id="egxBanner" aria-roledescription="carousel" aria-label="Offers"
                 x-data="{
                    index: 0,
                    count: {{ $sliders->count() }},
                    timer: null,
                    go(i) { this.index = (i + this.count) % this.count },
                    init() { if (this.count > 1) this.timer = setInterval(() => this.go(this.index + 1), 5000) },
                    pause() { if (this.timer) { clearInterval(this.timer); this.timer = null } },
                    play() { if (!this.timer && this.count > 1) this.timer = setInterval(() => this.go(this.index + 1), 5000) }
                 }"
                 @mouseenter="pause()" @mouseleave="play()">
            <div class="egxb-track" :style="'transform: translateX(-' + (index * 100) + '%)'">
                @foreach ($sliders as $slider)
                    <a class="egxb-slide" href="{{ $slider->link ?: route('products.index') }}"
                       @if (! $loop->first) tabindex="-1" @endif>
                        @if ($slider->image)
                            <img src="{{ media_url($slider->image) }}" alt="{{ $slider->title }}"
                                 @if ($loop->first) fetchpriority="high" @endif loading="lazy">
                        @else
                            <img src="https://picsum.photos/seed/egx-slider-{{ $loop->index }}/1600/650" alt="{{ $slider->title }}" loading="lazy">
                        @endif
                    </a>
                @endforeach
            </div>

            @if ($sliders->count() > 1)
                <button type="button" class="egxb-arrow egxb-prev" @click="go(index - 1)" aria-label="Previous slide">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button type="button" class="egxb-arrow egxb-next" @click="go(index + 1)" aria-label="Next slide">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
                <div class="egxb-dots">
                    @foreach ($sliders as $index => $slider)
                        <button type="button" class="egxb-dot" :class="index === {{ $index }} ? 'is-active' : ''"
                                @click="go({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- Categories marquee (EGX .egxp authorized-partner strip)           --}}
    {{-- ================================================================= --}}
    @if ($categories->isNotEmpty())
        <section class="egxp" aria-labelledby="egxpTitle">
            <h3 class="egxp-title" id="egxpTitle">Our Product Categories</h3>
            <div class="egxp-viewport is-scrolling">
                <div class="egxp-track">
                    @foreach ($categories as $category)
                        <a class="egxp-item" href="{{ route('products.index', ['category' => $category->slug]) }}">
                            @if ($category->image)
                                <img src="{{ media_url($category->image) }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <span class="egxp-emoji">🛍️</span>
                            @endif
                            <span class="egxp-name">{{ $category->name }}</span>
                        </a>
                    @endforeach
                    @foreach ($categories as $category)
                        <a class="egxp-item" href="{{ route('products.index', ['category' => $category->slug]) }}" aria-hidden="true" tabindex="-1">
                            @if ($category->image)
                                <img src="{{ media_url($category->image) }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <span class="egxp-emoji">🛍️</span>
                            @endif
                            <span class="egxp-name">{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- Featured band                                                     --}}
    {{-- ================================================================= --}}
    @if ($featured->isNotEmpty())
        <div class="egx-band">
            <div class="products-container">
                <div class="egx-section-head">
                    <h2>{{ setting('featured_title', 'Featured Products') }}</h2>
                    <a href="{{ route('products.index') }}">View All →</a>
                </div>
                <div class="ms-row-container">
                    <div class="ms-products-grid">
                        @foreach ($featured->take(6) as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ================================================================= --}}
    {{-- Category bands (EGX .ms-products-grid sections)                    --}}
    {{-- ================================================================= --}}
    @foreach ($categories as $category)
        @if ($category->products->isNotEmpty())
            <div class="egx-band">
                <div class="products-container">
                    <div class="egx-section-head">
                        <h2>{{ $category->name }}</h2>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}">View All →</a>
                    </div>
                    <div class="ms-row-container">
                        <div class="ms-products-grid">
                            @foreach ($category->products->take(6) as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{-- ================================================================= --}}
    {{-- Promo containers (EGX .promo-card grid)                            --}}
    {{-- ================================================================= --}}
    @if ($banners->isNotEmpty())
        <div class="products-container egx-promo-wrap">
            <div class="egx-section-head">
                <h2>Offers &amp; Promotions</h2>
            </div>
            <div class="egx-promo-grid">
                @foreach ($banners as $banner)
                    <a class="promo-card" href="{{ $banner->link ?: route('products.index') }}">
                        @if ($banner->image)
                            <img src="{{ media_url($banner->image) }}" alt="{{ $banner->title }}" loading="lazy"
                                 style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                        @else
                            <div style="width:100%;height:100%;position:absolute;inset:0;background:linear-gradient(135deg,#052f88,#1d4ed8);"></div>
                        @endif
                        <div class="promo-card-overlay"></div>
                        <div class="egx-promo-content">
                            <span class="egx-promo-title">{{ $banner->title }}</span>
                            @if ($banner->subtitle)
                                <span class="egx-promo-sub">{{ $banner->subtitle }}</span>
                            @endif
                            @if ($banner->button_text)
                                <span class="egx-promo-btn">{{ $banner->button_text }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ================================================================= --}}
    {{-- SEO / store info text block (EGX .seo-text-block)                 --}}
    {{-- ================================================================= --}}
    <div class="seo-text-block">
        <h2>{{ $siteName ?? setting('site_name', config('app.name')) }} — digital products, delivered instantly</h2>
        <p>
            {{ setting('site_description', 'Buy premium digital products and subscriptions online with instant delivery.') }}
            Browse the full catalogue, choose a monthly or yearly plan and pay securely online or via bank transfer.
            Your products, license keys and access details are delivered to your dashboard the moment your payment is confirmed.
        </p>
        <p>
            Every order includes a professional PDF invoice and email confirmation. Need help choosing a plan?
            Reach us on WhatsApp or via the contact page — our team replies fast.
        </p>
        <p>
            @if (setting('contact_phone'))
                <strong>Hotline:</strong> {{ setting('contact_phone') }} ·
            @endif
            @if (setting('contact_email'))
                <strong>Email:</strong> {{ setting('contact_email') }}
            @endif
        </p>
    </div>
@endsection