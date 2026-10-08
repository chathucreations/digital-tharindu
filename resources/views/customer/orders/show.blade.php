@extends('layouts.customer')

@section('title', 'Order ' . $order->order_number)

@section('customer-content')
    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <a href="{{ route('customer.orders.index') }}" class="text-sm font-semibold text-slate-400 hover:text-indigo-600">← Back to orders</a>
            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Order {{ $order->order_number }}</h1>
            <p class="mt-1 text-slate-500">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            @if ($order->invoice)
                <a href="{{ route('customer.invoices.download', $order->invoice) }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-700">
                    <x-ui-icon name="download" class="h-4 w-4" /> Invoice PDF
                </a>
            @endif
            @if ($order->payment_status === 'failed' && $order->payment_method === 'online_gateway')
                <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50">
                    Try Again
                </a>
            @endif
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <div class="text-xs font-bold uppercase tracking-wide text-slate-400">Payment</div>
            <div class="mt-2">
                <span class="rounded-full px-3 py-1 text-sm font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : ($order->payment_status === 'failed' ? 'bg-rose-50 text-rose-700' : 'bg-amber-50 text-amber-700') }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
            <div class="mt-2 text-xs text-slate-500">{{ $order->payment_method === 'online_gateway' ? 'Online Payment Gateway' : 'Bank Transfer (Offline)' }}</div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <div class="text-xs font-bold uppercase tracking-wide text-slate-400">Order Status</div>
            <div class="mt-2">
                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-bold text-slate-700">{{ ucfirst($order->order_status) }}</span>
            </div>
            @if ($order->paid_at)
                <div class="mt-2 text-xs text-slate-500">Paid {{ $order->paid_at->format('M d, Y') }}</div>
            @endif
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <div class="text-xs font-bold uppercase tracking-wide text-slate-400">Total</div>
            <div class="mt-2 text-2xl font-extrabold text-indigo-600">{{ money($order->total_amount) }}</div>
        </div>
    </div>

    @if ($order->payment_method === 'offline' && $order->payment_status !== 'paid')
        <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-6">
            <h2 class="flex items-center gap-2 text-base font-extrabold text-amber-900">
                <x-ui-icon name="bank" class="h-5 w-5" /> Bank Transfer Payment
            </h2>
            <p class="mt-1 text-sm text-amber-800">
                Transfer <strong>{{ money($order->total_amount) }}</strong> to the account below using
                <strong>{{ $order->order_number }}</strong> as the reference, then upload your receipt.
            </p>

            <dl class="mt-4 grid gap-x-8 gap-y-2 text-sm sm:grid-cols-2">
                @foreach ([
                    'Bank' => setting('bank_name'),
                    'Branch' => setting('bank_branch'),
                    'Account Name' => setting('bank_account_name'),
                    'Account Number' => setting('bank_account_number'),
                    'SWIFT / Code' => setting('bank_swift'),
                ] as $label => $value)
                    @if ($value)
                        <div class="flex justify-between gap-4 border-b border-amber-100 py-1">
                            <dt class="text-amber-700">{{ $label }}</dt>
                            <dd class="font-semibold text-slate-800">{{ $value }}</dd>
                        </div>
                    @endif
                @endforeach
            </dl>

            @if (setting('bank_instructions'))
                <p class="mt-3 whitespace-pre-line text-sm text-amber-800">{{ setting('bank_instructions') }}</p>
            @endif

            @if ($order->offline_receipt)
                <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    <strong>Payment proof submitted.</strong> We are verifying your payment and will activate your order shortly.
                    <a href="{{ media_url($order->offline_receipt) }}" target="_blank" class="ml-1 font-semibold underline">View receipt</a>
                </div>
            @else
                <form method="POST" action="{{ route('customer.orders.proof', $order) }}" enctype="multipart/form-data"
                      class="mt-5 space-y-4 rounded-xl border border-amber-100 bg-white p-4">
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Upload Payment Receipt *</label>
                        <input type="file" name="offline_receipt" accept=".jpg,.jpeg,.png,.pdf"
                               class="w-full rounded-xl border border-slate-300 p-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                        <p class="mt-1 text-xs text-slate-400">JPG, PNG or PDF up to 5MB.</p>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Note / Reference</label>
                        <textarea name="offline_note" rows="3" placeholder="Bank reference, deposit date, etc."
                                  class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('offline_note', $order->offline_note) }}</textarea>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700">
                        <x-ui-icon name="download" class="h-4 w-4 rotate-180" /> Submit Payment Proof
                    </button>
                </form>
            @endif
        </div>
    @endif

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
        <h2 class="border-b border-slate-100 px-5 py-4 font-extrabold text-slate-900">Items &amp; Access</h2>
        <ul class="divide-y divide-slate-100">
            @foreach ($order->items as $item)
                <li class="p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="font-bold text-slate-900">{{ $item->product_name }}</div>
                            <div class="text-sm text-slate-500">{{ $item->billing_cycle ? ucfirst($item->billing_cycle) . ' billing' : 'Standard' }}</div>
                        </div>
                        <div class="font-bold text-slate-900">{{ money($item->price) }}</div>
                    </div>

                    @if ($order->order_status === 'completed')
                        <div class="mt-3 rounded-xl bg-slate-50 p-4 text-sm text-slate-600">
                            <div class="mb-1 text-xs font-bold uppercase tracking-wide text-slate-400">Access Details</div>
                            <div class="whitespace-pre-line">{{ $item->product?->access_details ?: 'Access this product from your dashboard.' }}</div>
                            @if ($item->product?->file_path)
                                <a href="{{ route('customer.products.download', $item) }}"
                                   class="mt-3 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-bold text-white hover:bg-indigo-700">
                                    <x-ui-icon name="download" class="h-4 w-4" /> Download File
                                </a>
                            @endif
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
