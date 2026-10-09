@extends('layouts.frontend')

@section('title', setting('meta_about_title') ?: 'About Us')
@section('meta_description', setting('meta_about_description'))
@section('canonical', route('about'))

@section('content')
    <div class="egx-hero">
        <div style="max-width:1272px;width:95%;margin:0 auto;padding:44px 0 38px;">
            <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.25);border-radius:99px;font-size:13px;font-weight:600;padding:5px 13px;">Our Story</span>
            <h1 style="margin-top:14px;">About {{ setting('site_name', config('app.name')) }}</h1>
            <p style="margin-top:8px;max-width:640px;font-size:16.5px;">{{ setting('tagline', 'Delivering premium digital products to customers across the globe.') }}</p>
        </div>
    </div>

    <div style="max-width:1272px;width:95%;margin:38px auto;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:start;">
            <div>
                <span style="font-size:13px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#1D4ED8;">Why Digital Store</span>
                <h2 style="margin-top:8px;font-size:30px;font-weight:800;color:#1A1D23;">Digital products made simple</h2>
                <div style="margin-top:14px;color:#2f2f2f;font-size:16px;line-height:1.75;">
                    <p>
                        {{ setting('site_name', config('app.name')) }} is your trusted destination for premium digital products and
                        subscriptions. We make it easy to discover, purchase and instantly access the tools and services you need —
                        without the wait, paperwork or shipping.
                    </p>
                    <p style="margin-top:12px;">
                        From the moment you place an order, everything is automated: secure payment, instant digital delivery,
                        and a professional invoice delivered straight to your inbox. Our team is always a message away should you
                        need a hand.
                    </p>
                </div>

                <div style="margin-top:24px;display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
                    @foreach ([
                        ['value' => '100%', 'label' => 'Digital delivery'],
                        ['value' => '24/7', 'label' => 'Customer support'],
                        ['value' => 'Secure', 'label' => 'Trusted payments'],
                    ] as $stat)
                        <div style="border:1.5px solid var(--border);background:#fff;border-radius:12px;padding:16px;text-align:center;box-shadow:0 2px 10px rgba(0,0,0,.05);">
                            <div style="font-size:24px;font-weight:900;color:#1D4ED8;">{{ $stat['value'] }}</div>
                            <div style="margin-top:2px;font-size:12.5px;font-weight:600;color:#6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                @foreach ([
                    ['icon' => '⚡', 'title' => 'Instant Access', 'text' => 'Your products are unlocked the moment your payment is confirmed.'],
                    ['icon' => '🛡️', 'title' => 'Secure & Safe', 'text' => 'Payments are processed through trusted gateways.'],
                    ['icon' => '🌍', 'title' => 'Global Reach', 'text' => 'Purchase from anywhere and access your products worldwide.'],
                    ['icon' => '🧾', 'title' => 'Professional Invoices', 'text' => 'Every order includes a downloadable PDF invoice.'],
                ] as $card)
                    <div style="border:1.5px solid var(--border);background:#fff;border-radius:12px;padding:18px;transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.05);">
                        <div style="font-size:26px;">{{ $card['icon'] }}</div>
                        <h3 style="margin-top:10px;font-weight:800;font-size:16px;color:#1A1D23;">{{ $card['title'] }}</h3>
                        <p style="margin-top:4px;font-size:13.5px;color:#6b7280;line-height:1.6;">{{ $card['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if ($categories->isNotEmpty())
        <div class="products-container" style="margin:34px auto 50px;padding:26px;">
            <div style="text-align:center;">
                <h2 style="font-size:25px;font-weight:800;color:#1A1D23;">What we offer</h2>
                <p style="margin-top:4px;color:#6b7280;">Explore our curated categories of digital products.</p>
                <div style="margin-top:18px;display:flex;flex-wrap:wrap;justify-content:center;gap:10px;">
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           style="display:inline-flex;align-items:center;gap:6px;border:1.5px solid var(--border);background:#fff;border-radius:99px;padding:8px 18px;font-size:14px;font-weight:700;color:#374151;transition:all .15s;">
                            @if ($category->image)
                                <img src="{{ media_url($category->image) }}" alt="" style="width:20px;height:20px;object-fit:contain;border-radius:4px;">
                            @endif
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection