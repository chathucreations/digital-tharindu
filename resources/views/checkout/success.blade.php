@extends('layouts.frontend')

@section('title', 'Order Status')

@section('content')
    @php
        $paid = $order->payment_status === 'paid';
        $failed = $order->payment_status === 'failed';
    @endphp

    <div class="mx-auto max-w-3xl px-4 py-14">
        <div class="rounded-3xl border p-8 text-center {{ $paid ? 'border-emerald-200 bg-emerald-50' : ($failed ? 'border-rose-200 bg-rose-50' : 'border-amber-200 bg-amber-50') }}">
            <span class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-white {{ $paid ? 'bg-emerald-500' : ($failed ? 'bg-rose-500' : 'bg-amber-500') }}">
                <x-ui-icon :name="$paid ? 'check-circle' : ($failed ? 'x' : 'clock')" class="h-8 w-8" />
            </span>
            <h1 class="mt-5 text-2xl font-extrabold text-slate-900">
                {{ $paid ? 'Payment Successful!' : ($failed ? 'Payment Failed' : 'Order Pending') }}
            </h1>
            <p class="mt-2 text-slate-600">
                @if ($paid)
                    Thank you! Your order <strong>{{ $order->order_number }}</strong> is complete and your digital products are ready.
                    A confirmation email with your invoice has been sent to {{ $order->user->email }}.
                @elseif ($failed)
                    We could not process the payment for order <strong>{{ $order->order_number }}</strong>. You can try again from your orders page.
                @else
                    Your order <strong>{{ $order->order_number }}</strong> is awaiting payment confirmation. We'll notify you by email once it's completed.
                @endif
            </p>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="text-sm font-bold uppercase tracking-wide text-slate-400">Order Summary</h2>
            <ul class="mt-4 divide-y divide-slate-100">
                @foreach ($order->items as $item)
                    <li class="flex items-start justify-between gap-4 py-3">
                        <div>
                            <div class="text-sm font-semibold text-slate-800">{{ $item->product_name }}</div>
                            <div class="text-xs text-slate-500">{{ $item->billing_cycle ? ucfirst($item->billing_cycle) : 'Standard' }}</div>
                            @if ($paid && $item->product?->access_details)
                                <div class="mt-2 rounded-lg bg-slate-50 p-3 text-xs text-slate-600 whitespace-pre-line">{{ $item->product->access_details }}</div>
                            @endif
                        </div>
                        <div class="text-sm font-bold text-slate-900">{{ money($item->price) }}</div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-between border-t border-slate-100 pt-4 text-base">
                <span class="font-bold text-slate-900">Total</span>
                <span class="font-extrabold text-indigo-600">{{ money($order->total_amount) }}</span>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('customer.orders.show', $order) }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white hover:bg-indigo-700">
                View Order <x-ui-icon name="arrow-right" class="h-4 w-4" />
            </a>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-6 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                Continue Shopping
            </a>
        </div>
    </div>
@endsection
