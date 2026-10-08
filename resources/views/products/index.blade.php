@extends('layouts.frontend')

@section('title', $selected?->meta_title ?: setting('meta_products_title') ?: ($selected?->name ?? 'Products'))
@section('meta_description', $selected?->meta_description ?: setting('meta_products_description'))
@section('meta_keywords', $selected?->meta_keywords ?: setting('default_meta_keywords'))
@section('og_image', $selected?->og_image ? media_url($selected->og_image) : null)

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12">
            <nav class="text-sm text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                <span class="mx-1">/</span>
                <span class="text-slate-600">Products</span>
            </nav>
            <h1 class="mt-2 text-3xl font-extrabold text-slate-900">
                {{ $selected ? $selected->name : 'All Products' }}
            </h1>
            <p class="mt-1 text-slate-500">
                {{ $selected?->description ?: 'Browse our full catalogue of premium digital products.' }}
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-10">
        <div class="grid gap-8 lg:grid-cols-[260px_1fr]">
            <!-- Sidebar filters -->
            <aside class="space-y-6" data-reveal="left">
                <form method="GET" action="{{ route('products.index') }}" class="rounded-2xl border border-slate-200 bg-white p-4">
                    <label class="mb-2 block text-sm font-bold text-slate-900">Search</label>
                    <div class="flex gap-2">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products"
                               class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button class="rounded-lg bg-indigo-600 px-3 text-white hover:bg-indigo-700" aria-label="Search">
                            <x-ui-icon name="sparkles" class="h-4 w-4" />
                        </button>
                    </div>
                </form>

                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <h3 class="mb-3 text-sm font-bold text-slate-900">Categories</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('products.index') }}"
                               class="block rounded-lg px-3 py-2 text-sm font-medium {{ ! $selected ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                                All Categories
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                   class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium {{ $selected && $selected->id === $category->id ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs text-slate-400">{{ $category->products_count ?? '' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Grid -->
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-slate-500">Showing {{ $products->count() }} of {{ $products->total() }} products</p>
                </div>

                @if ($products->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-16 text-center">
                        <x-ui-icon name="bag" class="mx-auto h-12 w-12 text-slate-300" />
                        <h3 class="mt-3 text-lg font-bold text-slate-900">No products found</h3>
                        <p class="mt-1 text-sm text-slate-500">Try a different category or search term.</p>
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
