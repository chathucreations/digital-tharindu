@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12">
            <h1 class="text-3xl font-extrabold text-slate-900">Checkout</h1>
            <p class="mt-1 text-slate-500">Complete your purchase securely. All products are delivered digitally.</p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-10" x-data="{ method: '{{ old('payment_method', $onlineEnabled ? 'online_gateway' : 'offline') }}' }">
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data"
              class="grid gap-8 lg:grid-cols-[1fr_380px]">
            @csrf

            <div class="space-y-6">
                <!-- Contact -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h2 class="text-lg font-extrabold text-slate-900">Contact Details</h2>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Name</label>
                            <input type="text" value="{{ auth()->user()->name }}" disabled
                                   class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm text-slate-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" disabled
                                   class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm text-slate-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Phone Number *</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   placeholder="94712345678" required
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-slate-400">Sri Lankan format: 947XXXXXXXX (e.g. 94712345678)</p>
                        </div>
                    </div>
                </div>

                <!-- Payment method -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h2 class="text-lg font-extrabold text-slate-900">Payment Method</h2>

                    <div class="mt-4 space-y-3">
                        @if ($onlineEnabled)
                            <label class="flex cursor-pointer items-start gap-4 rounded-2xl border-2 border-slate-200 p-4 transition"
                                   :class="method === 'online_gateway' ? 'border-[#1D4ED8] bg-blue-50' : ''">
                                <input type="radio" name="payment_method" value="online_gateway" x-model="method" class="mt-1 text-[#1D4ED8] focus:ring-blue-500" @checked(old('payment_method', 'online_gateway') === 'online_gateway')>
                                <span class="flex-1">
                                    <span class="flex items-center gap-2 font-bold text-slate-900">
                                        <x-ui-icon name="credit-card" class="h-5 w-5 text-[#1D4ED8]" /> Online Payment Gateway
                                    </span>
                                    <span class="mt-1 block text-sm text-slate-500">Pay securely by card via Marx IPG. Instant delivery on success.</span>
                                </span>
                            </label>
                        @else
                            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                                Online card payments are temporarily unavailable. Please use bank transfer below.
                            </div>
                        @endif

                        <label class="flex cursor-pointer items-start gap-4 rounded-2xl border-2 border-slate-200 p-4 transition"
                               :class="method === 'offline' ? 'border-[#1D4ED8] bg-blue-50' : ''">
                            <input type="radio" name="payment_method" value="offline" x-model="method" class="mt-1 text-[#1D4ED8] focus:ring-blue-500" @checked(old('payment_method') === 'offline')>
                            <span class="flex-1">
                                <span class="flex items-center gap-2 font-bold text-slate-900">
                                    <x-ui-icon name="bank" class="h-5 w-5 text-[#1D4ED8]" /> Bank Transfer (Offline)
                                </span>
                                <span class="mt-1 block text-sm text-slate-500">Deposit to our bank account and upload your receipt. We'll verify and deliver.</span>
                            </span>
                        </label>
                    </div>

                    <!-- Offline bank details -->
                    <div x-show="method === 'offline'" x-cloak x-transition class="mt-6 rounded-2xl bg-slate-50 p-5 text-sm">
                        <p class="font-semibold text-slate-800">Bank Transfer Details</p>

                        <dl class="mt-3 grid gap-x-8 gap-y-1 sm:grid-cols-2">
                            @foreach ([
                                'Bank' => setting('bank_name'),
                                'Branch' => setting('bank_branch'),
                                'Account Name' => setting('bank_account_name'),
                                'Account Number' => setting('bank_account_number'),
                                'SWIFT / Code' => setting('bank_swift'),
                            ] as $label => $value)
                                @if ($value)
                                    <div class="flex justify-between gap-4 border-b border-slate-200 py-1.5">
                                        <dt class="text-slate-500">{{ $label }}</dt>
                                        <dd class="text-right font-semibold text-slate-800">{{ $value }}</dd>
                                    </div>
                                @endif
                            @endforeach
                        </dl>

                        @if (setting('bank_instructions'))
                            <p class="mt-3 whitespace-pre-line text-xs text-slate-500">{{ setting('bank_instructions') }}</p>
                        @endif

                        <p class="mt-3 text-xs font-medium text-slate-500">
                            Place your order using the button below, then upload your payment receipt from your dashboard to confirm.
                        </p>
                    </div>
                </div>

                <label class="flex items-start gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="terms" value="1" required class="mt-0.5 rounded text-[#1D4ED8] focus:ring-blue-500">
                    <span>I agree to the terms of service and understand that digital products are non-refundable once delivered.</span>
                </label>
            </div>

            <!-- Summary -->
            <aside class="lg:sticky lg:top-28 lg:self-start">
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h2 class="text-lg font-extrabold text-slate-900">Your Order</h2>
                    <ul class="mt-4 divide-y divide-slate-100">
                        @foreach ($items as $item)
                            <li class="flex items-start justify-between gap-3 py-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-800">{{ $item['name'] }}</div>
                                    <div class="text-xs text-slate-500">{{ $item['billing_cycle'] ? ucfirst($item['billing_cycle']) : 'Standard' }}</div>
                                </div>
                                <div class="text-sm font-bold text-slate-900">{{ money($item['price']) }}</div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 flex justify-between border-t border-slate-100 pt-4 text-base">
                        <span class="font-bold text-slate-900">Total</span>
                        <span class="font-extrabold text-[#1D4ED8]">{{ money($subtotal) }}</span>
                    </div>

                    <button type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-[#1D4ED8] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#1D4ED8]/30 transition hover:bg-[#052f88]">
                        <x-ui-icon name="lock" class="h-4 w-4" />
                        <span x-text="method === 'offline' ? 'Place Order' : 'Pay Now'"></span>
                    </button>
                </div>
            </aside>
        </form>
    </div>
@endsection
