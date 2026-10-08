@extends('layouts.customer')

@section('title', 'My Dashboard')

@section('customer-content')
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
        <p class="mt-1 text-slate-500">Here's an overview of your account and orders.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4" data-reveal>
        @foreach ([
            ['label' => 'Total Orders', 'value' => $stats['orders'], 'icon' => 'receipt', 'class' => 'bg-indigo-50 text-indigo-600'],
            ['label' => 'Completed', 'value' => $stats['completed'], 'icon' => 'check-circle', 'class' => 'bg-emerald-50 text-emerald-600'],
            ['label' => 'Pending', 'value' => $stats['pending'], 'icon' => 'clock', 'class' => 'bg-amber-50 text-amber-600'],
            ['label' => 'Total Spent', 'value' => money($stats['spent']), 'icon' => 'bank', 'class' => 'bg-violet-50 text-violet-600'],
        ] as $card)
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $card['class'] }}">
                    <x-ui-icon :name="$card['icon']" class="h-5 w-5" />
                </span>
                <div class="mt-3 text-2xl font-extrabold text-slate-900">{{ $card['value'] }}</div>
                <div class="text-sm text-slate-500">{{ $card['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 rounded-2xl border border-slate-200 bg-white" data-reveal>
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h2 class="font-extrabold text-slate-900">Recent Orders</h2>
            <a href="{{ route('customer.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700">View all</a>
        </div>

        @if ($orders->isEmpty())
            <div class="p-10 text-center text-sm text-slate-500">
                You haven't placed any orders yet.
                <a href="{{ route('products.index') }}" class="font-semibold text-indigo-600">Browse products →</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Order</th>
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
                                <td class="px-5 py-3">{{ money($order->total_amount) }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : ($order->payment_status === 'failed' ? 'bg-rose-50 text-rose-700' : 'bg-amber-50 text-amber-700') }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">{{ ucfirst($order->order_status) }}</span>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('customer.orders.show', $order) }}" class="font-semibold text-indigo-600 hover:text-indigo-700">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
