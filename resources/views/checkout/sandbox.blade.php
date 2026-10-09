@extends('layouts.frontend')

@section('title', 'Sandbox Payment')

@section('content')
    <div class="mx-auto max-w-xl px-4 py-16">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="text-lg font-extrabold text-slate-900">Marx IPG — Sandbox</div>
                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">TEST MODE</span>
            </div>
            <p class="mt-2 text-sm text-slate-500">
                No live gateway credentials are configured, so this simulated page stands in for the Marx IPG
                payment screen. Use it to test the full order fulfilment flow.
            </p>

            <div class="mt-6 rounded-2xl bg-slate-50 p-5 text-sm">
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Merchant Reference</span>
                    <span class="font-semibold text-slate-800">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Customer</span>
                    <span class="font-semibold text-slate-800">{{ $order->user->email }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Amount</span>
                    <span class="font-extrabold text-[#1D4ED8]">{{ money($order->total_amount) }}</span>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <form method="POST" action="{{ route('checkout.marx.sandbox.complete', $order) }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700">
                        Pay {{ money($order->total_amount) }}
                    </button>
                </form>
                <a href="{{ route('checkout.marx.sandbox.cancel', $order) }}"
                   class="flex-1 rounded-xl border border-slate-300 px-6 py-3 text-center text-sm font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </div>
    </div>
@endsection
