@extends('layouts.frontend')

@section('title', setting('meta_contact_title') ?: 'Contact Us')
@section('meta_description', setting('meta_contact_description'))
@section('canonical', route('contact'))

@section('content')
    <div class="egx-hero">
        <div style="max-width:1272px;width:95%;margin:0 auto;padding:44px 0 38px;">
            <h1 style="margin-top:0;">Get in Touch</h1>
            <p style="margin-top:8px;max-width:640px;font-size:16.5px;">Have a question about a product or your order? Our team is happy to help.</p>
        </div>
    </div>

    <div style="max-width:1272px;width:95%;margin:38px auto 54px;display:grid;grid-template-columns:360px 1fr;gap:22px;">
        <div style="display:flex;flex-direction:column;gap:14px;">
            @foreach (array_filter([
                setting('contact_address') ? ['icon' => '📍', 'label' => 'Address', 'value' => setting('contact_address')] : null,
                setting('contact_phone') ? ['icon' => '📞', 'label' => 'Phone', 'value' => setting('contact_phone')] : null,
                setting('contact_email') ? ['icon' => '✉️', 'label' => 'Email', 'value' => setting('contact_email')] : null,
                setting('whatsapp_number') ? ['icon' => '💬', 'label' => 'WhatsApp', 'value' => setting('whatsapp_number')] : null,
            ]) as $info)
                <div style="display:flex;align-items:flex-start;gap:14px;border:1.5px solid var(--border);background:#fff;border-radius:12px;padding:16px;box-shadow:0 2px 8px rgba(0,0,0,.05);">
                    <span style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:10px;background:#EEF2FF;font-size:20px;flex-shrink:0;">{{ $info['icon'] }}</span>
                    <div>
                        <div style="font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#9CA3AF;">{{ $info['label'] }}</div>
                        <div style="margin-top:2px;font-weight:700;font-size:15px;color:#1A1D23;">{{ $info['value'] }}</div>
                    </div>
                </div>
            @endforeach

            @if (setting('whatsapp_number'))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}"
                   target="_blank" rel="noopener"
                   style="display:flex;align-items:center;justify-content:center;gap:8px;border:1.5px solid #BBF7D0;background:#F0FDF4;border-radius:12px;padding:16px;font-weight:800;font-size:15px;color:#15803d;">
                    💬 Chat on WhatsApp
                </a>
            @endif
        </div>

        <div class="products-container" style="padding:26px;">
            <h2 style="font-size:22px;font-weight:800;color:#1A1D23;">Send us a message</h2>
            <p style="margin-top:2px;font-size:14px;color:#6b7280;">Fill in the form below and we'll get back to you as soon as possible.</p>

            @if ($errors->any())
                <div style="margin-top:16px;border:1px solid #FECACA;background:#FEF2F2;color:#b91c1c;border-radius:9px;padding:12px 14px;font-size:14px;">
                    <ul style="margin-left:16px;list-style:disc;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" style="margin-top:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                @csrf
                <div>
                    <label class="egx-label" for="name">Full Name *</label>
                    <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required class="egx-input">
                </div>
                <div>
                    <label class="egx-label" for="email">Email *</label>
                    <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="egx-input">
                </div>
                <div>
                    <label class="egx-label" for="phone">Phone</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="94712345678" class="egx-input">
                    <p style="margin-top:4px;font-size:12px;color:#9CA3AF;">Format: 947XXXXXXXX</p>
                </div>
                <div>
                    <label class="egx-label" for="subject">Subject</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject') }}" class="egx-input">
                </div>
                <div style="grid-column:1/-1">
                    <label class="egx-label" for="message">Message *</label>
                    <textarea id="message" name="message" rows="5" required class="egx-input" style="resize:vertical;">{{ old('message') }}</textarea>
                </div>
                @if (setting('recaptcha_enabled') && setting('recaptcha_site_key'))
                    <div style="grid-column:1/-1">
                        <div class="g-recaptcha" data-sitekey="{{ setting('recaptcha_site_key') }}"></div>
                        @error('g-recaptcha-response')
                            <p style="margin-top:6px;font-size:13px;color:#dc2626;">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                <div style="grid-column:1/-1">
                    <button type="submit" class="egx-btn">✉️ Send Message</button>
                </div>
            </form>
        </div>
    </div>
@endsection