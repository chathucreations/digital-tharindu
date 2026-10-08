@extends('layouts.frontend')

@section('title', 'Shopping Cart')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12">
            <h1 class="text-3xl font-extrabold text-slate-900">Shopping Cart</h1>
            <p class="mt-1 text-slate-500">Review your selected digital products before checkout.</p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-10">
        @if (empty($items))
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-16 text-center">
                <x-ui-icon name="cart" class="mx-auto h-14 w-14 text-slate-300" />
                <h2 class="mt-4 text-xl font-bold text-slate-900">Your cart is empty</h2>
                <p class="mt-1 text-slate-500">Browse our products and add something you love.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white hover:bg-indigo-700">
                    Browse Products <x-ui-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                    <ul class="divide-y divide-slate-100">
                        @foreach ($items as $key => $item)
                            <li class="flex items-center gap-4 p-5">
                                <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">
                                    @if (! empty($item['image']))
                                        <img src="{{ media_url($item['image']) }}" class="h-full w-full object-cover" alt="">
                                    @else
                                        <x-ui-icon name="bag" class="h-7 w-7 text-slate-300" />
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="font-bold text-slate-900">{{ $item['name'] }}</div>
                                    <div class="text-sm text-slate-500">
                                        {{ $item['billing_cycle'] ? ucfirst($item['billing_cycle']) . ' billing' : 'Standard' }}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-slate-900">{{ money($item['price']) }}</div>
                                </div>
                                <form method="POST" action="{{ route('cart.destroy', $key) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-slate-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                        <x-ui-icon name="x" class="h-5 w-5" />
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="lg:sticky lg:top-28 lg:self-start">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <h2 class="text-lg font-extrabold text-slate-900">Order Summary</h2>
                        <dl class="mt-4 space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-slate-500">Subtotal ({{ count($items) }} item{{ count($items) > 1 ? 's' : '' }})</dt>
                                <dd class="font-semibold text-slate-900">{{ money($subtotal) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-slate-500">Tax</dt>
                                <dd class="font-semibold text-slate-900">{{ money(0) }}</dd>
                            </div>
                            <div class="flex justify-between border-t border-slate-100 pt-3 text-base">
                                <dt class="font-bold text-slate-900">Total</dt>
                                <dd class="font-extrabold text-indigo-600">{{ money($subtotal) }}</dd>
                            </div>
                        </dl>

                        <a href="{{ route('checkout.index') }}"
                           class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-700">
                            <x-ui-icon name="lock" class="h-4 w-4" /> Proceed to Checkout
                        </a>
                        <a href="{{ route('products.index') }}" class="mt-3 block text-center text-sm font-semibold text-slate-500 hover:text-indigo-600">
                            Continue shopping
                        </a>

                        <form method="POST" action="{{ route('cart.clear') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full text-center text-xs font-medium text-slate-400 hover:text-rose-500">Clear cart</button>
                        </form>
                    </div>
                </aside>
            </div>
        @endif
    </div>
@endsection
