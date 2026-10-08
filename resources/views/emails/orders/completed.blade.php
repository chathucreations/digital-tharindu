<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
<div style="max-width:640px;margin:0 auto;padding:24px;">
    <div style="background:#4f46e5;border-radius:12px 12px 0 0;padding:28px;text-align:center;">
        <h1 style="margin:0;color:#ffffff;font-size:22px;">{{ setting('site_name', config('app.name')) }}</h1>
        <p style="margin:6px 0 0;color:#c7d2fe;font-size:13px;">Your digital products are ready</p>
    </div>

    <div style="background:#ffffff;padding:28px;border-radius:0 0 12px 12px;">
        <p style="font-size:15px;">Hi {{ $order->user->name }},</p>
        <p style="font-size:14px;color:#4b5563;line-height:1.6;">
            Thank you for your purchase. Your payment for order
            <strong>{{ $order->order_number }}</strong> has been confirmed and your
            digital products are now available in your account. Your invoice is attached to this email.
        </p>

        <h2 style="font-size:15px;margin-top:28px;border-bottom:2px solid #eef2ff;padding-bottom:8px;">Order Summary</h2>
        <table style="width:100%;border-collapse:collapse;font-size:13px;">
            @foreach ($order->items as $item)
                <tr>
                    <td style="padding:10px 0;border-bottom:1px solid #f3f4f6;">
                        <strong>{{ $item->product_name }}</strong><br>
                        <span style="color:#6b7280;">{{ $item->billing_cycle ? ucfirst($item->billing_cycle) : 'Standard' }} billing</span>
                    </td>
                    <td style="padding:10px 0;border-bottom:1px solid #f3f4f6;text-align:right;">
                        {{ money($item->price, setting('currency_symbol', 'Rs.')) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td style="padding:12px 0;font-weight:bold;">Total</td>
                <td style="padding:12px 0;text-align:right;font-weight:bold;">
                    {{ money($order->total_amount, setting('currency_symbol', 'Rs.')) }}
                </td>
            </tr>
        </table>

        <h2 style="font-size:15px;margin-top:28px;border-bottom:2px solid #eef2ff;padding-bottom:8px;">Your Access Details</h2>
        @foreach ($order->items as $item)
            <div style="margin-top:14px;padding:14px;background:#f8fafc;border-left:4px solid #4f46e5;border-radius:6px;">
                <strong style="font-size:13px;">{{ $item->product_name }}</strong>
                <p style="margin:8px 0 0;font-size:13px;color:#374151;white-space:pre-line;">
                    {{ $item->product?->access_details ?: 'Access this product any time from your account dashboard.' }}
                </p>
                <p style="margin:8px 0 0;">
                    <a href="{{ route('customer.products') }}" style="color:#4f46e5;font-size:13px;">Open your dashboard &rarr;</a>
                </p>
            </div>
        @endforeach

        <div style="margin-top:30px;text-align:center;">
            <a href="{{ url('/customer/orders/' . $order->id) }}"
               style="display:inline-block;background:#4f46e5;color:#ffffff;text-decoration:none;padding:12px 26px;border-radius:8px;font-size:14px;">
                View Order &amp; Download Invoice
            </a>
        </div>
    </div>

    <p style="text-align:center;color:#9ca3af;font-size:12px;margin-top:18px;">
        &copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. All rights reserved.
    </p>
</div>
</body>
</html>
