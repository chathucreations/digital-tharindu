@props(['product'])

@php
    $monthly = $product->variations->firstWhere('billing_cycle', 'monthly');
    $yearly = $product->variations->firstWhere('billing_cycle', 'yearly');
    $primary = $monthly ?? $yearly;
    $image = $product->image ? media_url($product->image) : null;
@endphp

<article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/70">
    <a href="{{ route('products.show', $product) }}" class="relative block aspect-[4/3] overflow-hidden bg-gradient-to-br from-indigo-50 to-slate-100">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        @else
            <div class="flex h-full w-full items-center justify-center text-indigo-300">
                <x-ui-icon name="bag" class="h-14 w-14" />
            </div>
        @endif

        @if ($product->is_featured)
            <span class="absolute left-3 top-3 rounded-full bg-amber-400 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-amber-900">Featured</span>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-4">
        <span class="text-xs font-bold uppercase tracking-wide text-indigo-600">{{ $product->category?->name }}</span>
        <h3 class="mt-1 line-clamp-2 text-base font-bold text-slate-900">
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </h3>
        <p class="mt-1 line-clamp-2 flex-1 text-sm text-slate-500">{{ $product->short_description }}</p>

        <div class="mt-4">
            @if ($primary)
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-extrabold text-slate-900">{{ money($primary->price) }}</span>
                    <span class="text-xs font-medium text-slate-500">/{{ $primary->billing_cycle === 'monthly' ? 'month' : 'year' }}</span>
                </div>
                @if ($monthly && $yearly)
                    <div class="text-xs text-slate-500">or {{ money($yearly->price) }} / year</div>
                @endif
            @else
                <div class="text-sm font-medium text-slate-400">Contact for pricing</div>
            @endif
        </div>

        @if ($product->variations->isNotEmpty())
            <form method="POST" action="{{ route('cart.store') }}" class="mt-4 space-y-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div>
                    <label for="plan-{{ $product->id }}" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-400">Choose plan</label>
                    <select id="plan-{{ $product->id }}" name="variation_id"
                            class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($product->variations->sortBy(fn ($v) => $v->billing_cycle === 'monthly' ? 0 : 1) as $variation)
                            <option value="{{ $variation->id }}">
                                {{ ucfirst($variation->billing_cycle) }} — {{ money($variation->price) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('products.show', $product) }}"
                       class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Details
                    </a>
                    @auth
                        <button type="submit"
                                class="flex-1 rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login', ['redirect' => route('products.show', $product)]) }}"
                           class="flex-1 rounded-xl bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Login to Buy
                        </a>
                    @endauth
                </div>
            </form>
        @else
            <div class="mt-4">
                <a href="{{ route('products.show', $product) }}"
                   class="block rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Details
                </a>
            </div>
        @endif
    </div>
</article>
