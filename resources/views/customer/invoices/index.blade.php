@extends('layouts.customer')

@section('title', 'My Invoices')

@section('customer-content')
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">My Invoices</h1>
        <p class="mt-1 text-slate-500">Download invoices for your completed orders.</p>
    </div>

    <!-- Bank transfer details -->
    @if (setting('bank_name') || setting('bank_account_number'))
        <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6" data-reveal>
            <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900">
                <x-ui-icon name="bank" class="h-5 w-5 text-[#1D4ED8]" /> Bank Transfer Details
            </h2>
            <p class="mt-1 text-sm text-slate-500">Use these details for offline (bank transfer) payments.</p>

            <dl class="mt-4 grid gap-x-8 gap-y-2 text-sm sm:grid-cols-2">
                @foreach ([
                    'Bank' => setting('bank_name'),
                    'Branch' => setting('bank_branch'),
                    'Account Name' => setting('bank_account_name'),
                    'Account Number' => setting('bank_account_number'),
                    'SWIFT / Code' => setting('bank_swift'),
                ] as $label => $value)
                    @if ($value)
                        <div class="flex justify-between gap-4 border-b border-slate-100 py-1.5">
                            <dt class="text-slate-500">{{ $label }}</dt>
                            <dd class="text-right font-semibold text-slate-800">{{ $value }}</dd>
                        </div>
                    @endif
                @endforeach
            </dl>

            @if (setting('bank_instructions'))
                <p class="mt-3 whitespace-pre-line text-sm text-slate-500">{{ setting('bank_instructions') }}</p>
            @endif
        </div>
    @endif

    <!-- Invoices -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white" data-reveal>
        @if ($invoices->isEmpty())
            <div class="p-12 text-center">
                <x-ui-icon name="receipt" class="mx-auto h-12 w-12 text-slate-300" />
                <h2 class="mt-3 font-bold text-slate-900">No invoices yet</h2>
                <p class="mt-1 text-sm text-slate-500">Invoices appear here once your payment is confirmed.</p>
                <a href="{{ route('products.index') }}" class="mt-5 inline-flex rounded-xl bg-[#1D4ED8] px-5 py-2.5 text-sm font-bold text-white hover:bg-[#052f88]">Browse Products</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Invoice</th>
                            <th class="px-5 py-3">Order</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3">Amount</th>
                            <th class="px-5 py-3 text-right">Download</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3 font-semibold text-slate-800">{{ $invoice->invoice_number }}</td>
                                <td class="px-5 py-3">
                                    <a href="{{ route('customer.orders.show', $invoice->order) }}" class="text-[#1D4ED8] hover:text-[#052f88]">
                                        {{ $invoice->order->order_number }}
                                    </a>
                                </td>
                                <td class="px-5 py-3 text-slate-500">{{ $invoice->created_at->format('M d, Y') }}</td>
                                <td class="px-5 py-3 font-semibold">{{ money($invoice->order->total_amount) }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('customer.invoices.download', $invoice) }}"
                                       class="inline-flex items-center gap-1.5 rounded-lg bg-[#1D4ED8] px-3 py-1.5 text-xs font-bold text-white hover:bg-[#052f88]">
                                        <x-ui-icon name="download" class="h-3.5 w-3.5" /> PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-5 py-3">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
@endsection
