@extends('layouts.frontend')

@section('title', $selected?->meta_title ?: setting('meta_products_title') ?: ($selected?->name ?? 'Products'))
@section('meta_description', $selected?->meta_description ?: setting('meta_products_description'))
@section('meta_keywords', $selected?->meta_keywords ?: setting('default_meta_keywords'))
@section('og_image', $selected?->og_image ? media_url($selected->og_image) : null)

@section('content')
    <div class="egx-hero">
        <div style="max-width:1272px;width:95%;margin:0 auto;padding:40px 0 34px;">
            <nav style="font-size:14px;color:rgba(255,255,255,.75)">
                <a href="{{ route('home') }}" style="color:#fff;font-weight:600">Home</a>
                <span style="margin:0 6px">/</span>
                <span>Products</span>
            </nav>
            <h1 style="margin-top:10px;">{{ $selected ? $selected->name : 'All Products' }}</h1>
            <p style="margin-top:6px;max-width:680px;font-size:16px;">
                {{ $selected?->description ?: 'Browse our full catalogue of premium digital products — secure payment, instant delivery.' }}
            </p>
        </div>
    </div>

    <div class="products-section" style="padding-top:22px;">
        <div class="products-container">
            {{-- Filter bar --}}
            <div class="filter-bar">
                <div class="filter-bar-inner">
                    <div class="filter-tabs">
                        <a class="filter-tab {{ ! $selected ? 'active' : '' }}" href="{{ route('products.index') }}">All</a>
                        @foreach ($categories as $category)
                            <a class="filter-tab {{ $selected && $selected->id === $category->id ? 'active' : '' }}"
                               href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <span class="results-count">Showing {{ $products->count() }} of {{ $products->total() }} products</span>
                </div>
            </div>

            {{-- Products grid --}}
            <div class="products-grid-wrap">
                @if ($products->isEmpty())
                    <div style="text-align:center;padding:60px 20px;">
                        <div style="font-size:52px;opacity:.3">🛍️</div>
                        <h3 style="margin-top:10px;font-size:20px;font-weight:800;color:#1A1D23">No products found</h3>
                        <p style="margin-top:4px;color:#6b7280">Try a different category or search term.</p>
                        <a href="{{ route('products.index') }}" class="egx-btn" style="margin-top:20px;">View All Products</a>
                    </div>
                @else
                    <div class="ms-products-grid">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if ($products->hasPages())
            <div style="max-width:1272px;width:95%;margin:26px auto 0;display:flex;justify-content:center;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection