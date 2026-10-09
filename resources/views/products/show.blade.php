@extends('layouts.frontend')

@section('title', $product->meta_title ?: $product->name)
@section('meta_description', $product->meta_description ?: $product->short_description)
@section('meta_keywords', $product->meta_keywords ?: setting('default_meta_keywords'))
@section('og_image', $product->og_image ? media_url($product->og_image) : ($product->image ? media_url($product->image) : null))
@section('canonical', route('products.show', $product))

@section('content')
    @php
        $image = $product->image ? media_url($product->image) : null;
        $gallery = $product->galleryImages();
        $variations = $product->variations->sortBy(fn ($v) => $v->billing_cycle === 'monthly' ? 0 : 1)->values();
    @endphp

    <div style="max-width:1272px;width:95%;margin:0 auto;padding:26px 0 10px;">
        <nav class="egx-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}">Products</a>
            @if ($product->category)
                <span>/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            @endif
        </nav>
    </div>

    <div class="products-container" style="margin-bottom:20px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:28px;padding:24px;align-items:start;">
            {{-- Image gallery --}}
            <div x-data="{ images: {{ Js::from($gallery) }}, current: 0 }"
                 style="border:1.5px solid var(--border);border-radius:14px;padding:14px;background:#fff;">
                <div class="egx-zoom" x-data="{ zx: 50, zy: 50 }"
                     @mousemove="zx = (($event.offsetX / $event.currentTarget.offsetWidth) * 100); zy = (($event.offsetY / $event.currentTarget.offsetHeight) * 100)"
                     @mouseleave="zx = 50; zy = 50">
                    <template x-if="images.length > 0">
                        <img :src="images[current]" :alt="'{{ e($product->name) }}'"
                             class="egx-zoom-img"
                             :style="'transform-origin: ' + zx + '% ' + zy + '%'">
                    </template>
                    <template x-if="images.length === 0">
                        <span style="font-size:88px;opacity:.3;font-weight:700;">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                    </template>
                </div>

                <div class="egx-thumbs" x-show="images.length > 1" x-cloak>
                    <template x-for="(img, i) in images" :key="i">
                        <button type="button" class="egx-thumb" :class="current === i ? 'is-active' : ''"
                                @click="current = i" :aria-label="'Show image ' + (i + 1)">
                            <img :src="img" :alt="'{{ e($product->name) }} — image ' + (i + 1)">
                        </button>
                    </template>
                </div>
            </div>

            {{-- Details --}}
            <div>
                <div style="font-size:14px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase;color:#6b7280;">{{ $product->category?->name }}</div>
                <h1 style="margin-top:6px;font-size:clamp(24px,3vw,34px);font-weight:800;color:#1A1D23;line-height:1.2;">{{ $product->name }}</h1>
                @if ($product->short_description)
                    <p style="margin-top:10px;color:#2f2f2f;font-size:16px;line-height:1.7;">{{ $product->short_description }}</p>
                @endif

                <div style="margin-top:16px;display:flex;flex-wrap:wrap;gap:10px;">
                    <span style="display:inline-flex;align-items:center;gap:6px;background:#F0FDF4;color:#16A34A;border:1px solid #BBF7D0;font-weight:700;font-size:13px;padding:6px 12px;border-radius:99px;">⚡ Instant delivery</span>
                    <span style="display:inline-flex;align-items:center;gap:6px;background:#EEF2FF;color:#1D4ED8;border:1px solid #C7D2FE;font-weight:700;font-size:13px;padding:6px 12px;border-radius:99px;">🛡️ Secure checkout</span>
                    <span style="display:inline-flex;align-items:center;gap:6px;background:#FFFBEB;color:#D97706;border:1px solid #FDE68A;font-weight:700;font-size:13px;padding:6px 12px;border-radius:99px;">🧾 PDF invoice</span>
                </div>

                <form x-data="{ selected: {{ $variations->first()?->id ?? 'null' }} }"
                      method="POST" action="{{ route('cart.store') }}" style="margin-top:26px;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if ($variations->isNotEmpty())
                        <div style="font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#6b7280;">Choose your plan</div>
                        <div style="margin-top:12px;display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            @foreach ($variations as $variation)
                                <label style="cursor:pointer;">
                                    <input type="radio" name="variation_id" value="{{ $variation->id }}"
                                           class="sr-only" x-model.number="selected" @checked($loop->first)>
                                    <div class="egx-plan-card" :class="selected === {{ $variation->id }} ? 'is-selected' : ''">
                                        <div style="display:flex;align-items:center;justify-content:space-between;">
                                            <span style="font-weight:800;color:#1A1D23;">{{ ucfirst($variation->billing_cycle) }}</span>
                                            <span style="font-size:12px;font-weight:600;color:#9CA3AF;">{{ $variation->billing_cycle === 'monthly' ? 'Billed monthly' : 'Billed annually' }}</span>
                                        </div>
                                        <div style="margin-top:6px;display:flex;align-items:baseline;gap:8px;flex-wrap:wrap;">
                                            @if ($variation->original_price && $variation->original_price > $variation->price)
                                                <span style="font-size:15px;font-weight:600;color:#9CA3AF;text-decoration:line-through;">{{ money($variation->original_price) }}</span>
                                                <span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;font-size:11px;font-weight:800;padding:2px 6px;border-radius:6px;">-{{ round((1 - ((float) $variation->price / (float) $variation->original_price)) * 100) }}%</span>
                                            @endif
                                            <span style="font-size:24px;font-weight:900;color:#1D4ED8;">{{ money($variation->price) }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @auth
                            <div style="margin-top:22px;display:flex;gap:12px;flex-wrap:wrap;">
                                <button type="submit" formaction="{{ route('cart.store') }}" class="egx-btn-outline" style="flex:1;min-width:180px;">
                                    🛒 Add to Cart
                                </button>
                                <button type="submit" formaction="{{ route('cart.buy') }}" class="egx-btn" style="flex:1;min-width:180px;">
                                    ⚡ Buy Now
                                </button>
                            </div>
                        @else
                            <div style="margin-top:22px;display:flex;gap:12px;flex-wrap:wrap;">
                                <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="egx-btn" style="flex:1;min-width:180px;">
                                    ⚡ Sign Up &amp; Buy
                                </a>
                                <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="egx-btn-outline" style="flex:1;min-width:180px;">
                                    🔒 Login
                                </a>
                            </div>
                            <p style="margin-top:10px;font-size:13px;color:#9CA3AF;">Sign up in seconds with Google — you'll return here to choose your plan and pay.</p>
                        @endauth
                    @else
                        <p style="margin-top:14px;background:#EEF0F5;border-radius:9px;padding:14px 16px;color:#6b7280;font-size:14px;">Pricing for this product is coming soon. Please contact us for details.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Description + sidebar --}}
    <div style="max-width:1272px;width:95%;margin:0 auto 30px;display:grid;grid-template-columns:1fr 320px;gap:20px;">
        <div class="products-container" style="padding:24px;">
            <h2 style="font-size:20px;font-weight:800;color:#1A1D23;">Product Description</h2>
            <div class="p-desc" style="margin-top:14px;color:#2f2f2f;font-size:15.5px;line-height:1.75;">
                {!! $product->description ?: '<p style="color:#9CA3AF;">No description provided.</p>' !!}
            </div>
        </div>

        <aside style="display:flex;flex-direction:column;gap:14px;">
            <div class="products-container" style="padding:20px;">
                <h3 style="font-weight:800;font-size:17px;color:#1A1D23;">What you get</h3>
                <ul style="margin-top:12px;display:flex;flex-direction:column;gap:10px;font-size:14px;color:#374151;list-style:none;padding:0;">
                    @foreach (['Digital delivery — no shipping', 'Access details in your dashboard', 'Professional PDF invoice', 'Email confirmation & receipt'] as $line)
                        <li style="display:flex;align-items:flex-start;gap:8px;">
                            <span style="color:#16A34A;font-weight:800;">✔</span> <span>{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if (setting('whatsapp_number'))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}"
                   target="_blank" rel="noopener"
                   style="display:flex;align-items:center;justify-content:center;gap:8px;border:1.5px solid #BBF7D0;background:#F0FDF4;border-radius:10px;padding:16px;font-weight:700;font-size:15px;color:#15803d;">
                    💬 Need help? Chat on WhatsApp
                </a>
            @endif
        </aside>
    </div>

    {{-- Related products --}}
    @if ($related->isNotEmpty())
        <div style="max-width:1272px;width:95%;margin:0 auto 50px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                <h2 style="font-size:25px;font-weight:800;color:#1A1D23;">You may also like</h2>
            </div>
            <div class="products-container">
                <div class="ms-row-container">
                    <div class="ms-products-grid">
                        @foreach ($related as $item)
                            <x-product-card :product="$item" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection