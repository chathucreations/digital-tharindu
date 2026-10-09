@extends('layouts.customer')

@section('title', 'My Orders')

@section('customer-content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">My Orders</h1>
            <p class="mt-1 text-slate-500">Track and manage all of your orders.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white" data-reveal>
        @if ($orders->isEmpty())
            <div class="p-12 text-center">
                <x-ui-icon name="receipt" class="mx-auto h-12 w-12 text-slate-300" />
                <h2 class="mt-3 font-bold text-slate-900">No orders yet</h2>
                <p class="mt-1 text-sm text-slate-500">Your orders will appear here once you make a purchase.</p>
                <a href="{{ route('products.index') }}" class="mt-5 inline-flex rounded-xl bg-[#1D4ED8] px-5 py-2.5 text-sm font-bold text-white hover:bg-[#052f88]">Browse Products</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Order</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3">Method</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Payment</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3 font-semibold text-slate-800">{{ $order->order_number }}</td>
                                <td class="px-5 py-3 text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-5 py-3">{{ $order->payment_method === 'online_gateway' ? 'Online' : 'Bank Transfer' }}</td>
                                <td class="px-5 py-3 font-semibold">{{ money($order->total_amount) }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : ($order->payment_status === 'failed' ? 'bg-rose-50 text-rose-700' : 'bg-amber-50 text-amber-700') }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">{{ ucfirst($order->order_status) }}</span>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('customer.orders.show', $order) }}" class="font-semibold text-[#1D4ED8] hover:text-[#052f88]">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-5 py-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
