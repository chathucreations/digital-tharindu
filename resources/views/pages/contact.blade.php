@extends('layouts.frontend')

@section('title', setting('meta_contact_title') ?: 'Contact Us')
@section('meta_description', setting('meta_contact_description'))
@section('canonical', route('contact'))

@section('content')
    <section class="relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 via-indigo-600 to-violet-600 opacity-90"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-20 text-center">
            <h1 class="text-4xl font-extrabold text-white md:text-5xl">Get in Touch</h1>
            <p class="mx-auto mt-4 max-w-2xl text-indigo-100">Have a question about a product or your order? Our team is happy to help.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-8 lg:grid-cols-[360px_1fr]">
            <div class="space-y-4" data-reveal="left">
                @foreach (array_filter([
                    setting('contact_address') ? ['icon' => 'map', 'label' => 'Address', 'value' => setting('contact_address')] : null,
                    setting('contact_phone') ? ['icon' => 'phone', 'label' => 'Phone', 'value' => setting('contact_phone')] : null,
                    setting('contact_email') ? ['icon' => 'envelope', 'label' => 'Email', 'value' => setting('contact_email')] : null,
                    setting('whatsapp_number') ? ['icon' => 'phone', 'label' => 'WhatsApp', 'value' => setting('whatsapp_number')] : null,
                ]) as $info)
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <x-ui-icon :name="$info['icon']" class="h-6 w-6" />
                        </span>
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wide text-slate-400">{{ $info['label'] }}</div>
                            <div class="mt-1 font-semibold text-slate-800">{{ $info['value'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 md:p-8" data-reveal="right">
                <h2 class="text-2xl font-extrabold text-slate-900">Send us a message</h2>
                <p class="mt-1 text-sm text-slate-500">Fill in the form below and we'll get back to you as soon as possible.</p>

                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="mt-6 grid gap-5 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                               class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email *</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                               class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}"
                               placeholder="94712345678"
                               class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-slate-400">Format: 947XXXXXXXX</p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                               class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Message *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full rounded-xl border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('message') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        @if (setting('recaptcha_enabled') && setting('recaptcha_site_key'))
                            <div class="g-recaptcha" data-sitekey="{{ setting('recaptcha_site_key') }}"></div>
                            @error('g-recaptcha-response')
                                <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-700">
                            <x-ui-icon name="envelope" class="h-4 w-4" /> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
