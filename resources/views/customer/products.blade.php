@extends('layouts.customer')

@section('title', 'My Products')

@section('customer-content')
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">My Digital Products</h1>
        <p class="mt-1 text-slate-500">Access everything you've purchased and any download files.</p>
    </div>

    @if ($items->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
            <x-ui-icon name="bag" class="mx-auto h-12 w-12 text-slate-300" />
            <h2 class="mt-3 font-bold text-slate-900">No products yet</h2>
            <p class="mt-1 text-sm text-slate-500">Products you purchase will be available here.</p>
            <a href="{{ route('products.index') }}" class="mt-5 inline-flex rounded-xl bg-[#1D4ED8] px-5 py-2.5 text-sm font-bold text-white hover:bg-[#052f88]">Browse Products</a>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($items as $item)
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">
                            @if ($item->product?->image)
                                <img src="{{ media_url($item->product->image) }}" class="h-full w-full object-cover" alt="">
                            @else
                                <x-ui-icon name="bag" class="h-6 w-6 text-slate-300" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="font-bold text-slate-900">{{ $item->product_name }}</div>
                            <div class="text-xs text-slate-500">
                                {{ $item->billing_cycle ? ucfirst($item->billing_cycle) . ' billing' : 'Standard' }}
                                · Order {{ $item->order->order_number }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 rounded-xl bg-slate-50 p-4 text-sm text-slate-600">
                        <div class="mb-1 text-xs font-bold uppercase tracking-wide text-slate-400">Access Details</div>
                        <div class="whitespace-pre-line">{{ $item->product?->access_details ?: 'Access via your account.' }}</div>
                    </div>

                    <div class="mt-4 flex gap-2">
                        @if ($item->product?->file_path)
                            <a href="{{ route('customer.products.download', $item) }}"
                               class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#1D4ED8] px-4 py-2.5 text-sm font-bold text-white hover:bg-[#052f88]">
                                <x-ui-icon name="download" class="h-4 w-4" /> Download
                            </a>
                        @endif
                        @if ($item->product)
                            <a href="{{ route('products.show', $item->product) }}"
                               class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50">
                                Details
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
