@props(['product'])

@php
    $image = $product->image ? media_url($product->image) : null;
    $info = $product->priceInfo();
    $price = $info['price'];
    $original = $info['original_price'];
    $discount = $info['discount_percent'];
    $cycle = $product->variations->count() > 1 ? true : $product->variations->first()?->billing_cycle;
@endphp

<div class="off-card ms-single-card">
    <div style="padding:10px 10px 0 10px;">
        <div style="position:relative;aspect-ratio:1/1;border-radius:8px;background:#f8fafc;overflow:hidden;">
            <a href="{{ route('products.show', $product) }}"
               title="{{ $product->name }}"
               style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                @if ($image)
                    <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy"
                         style="width:100%;height:100%;object-fit:contain;border-radius:8px;">
                @else
                    <span style="font-size:42px;opacity:.35;font-weight:700;">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                @endif
            </a>
            <a class="hover-buy-btn" href="{{ route('products.show', $product) }}">Buy Now</a>
        </div>
    </div>

    <div class="off-bot">
        <a class="off-name" href="{{ route('products.show', $product) }}"
           title="{{ $product->name }}">{{ $product->name }}</a>

        <div class="off-price-row" style="display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap;">
            @if ($price !== null)
                @if ($discount && $original !== null)
                    <span class="egx-price-original">{{ money($original) }}</span>
                    <span class="egx-discount">-{{ $discount }}%</span>
                @endif
                <span style="color:#1A1D23;font-size:19px;font-weight:900;">{{ money($price) }}</span>
                @if ($cycle === true || $product->hasCycle('monthly'))
                    <span style="color:#9CA3AF;font-size:12px;font-weight:600;">/ month</span>
                @endif
            @else
                <span style="color:#9CA3AF;font-size:14px;font-weight:600;">Contact for pricing</span>
            @endif
        </div>

        <div style="text-align:center;margin-top:6px;">
            <span style="display:inline-block;border:1.5px solid #0097a7;color:#0097a7;font-size:12px;font-weight:700;border-radius:4px;padding:1px 8px;">In Stock</span>
        </div>
    </div>
</div>