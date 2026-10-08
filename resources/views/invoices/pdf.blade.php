<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { color: #1f2937; font-size: 12px; margin: 0; padding: 0; }
        .wrap { padding: 36px 40px; }
        .header { width: 100%; border-bottom: 3px solid #4f46e5; padding-bottom: 16px; margin-bottom: 24px; }
        .header td { vertical-align: top; }
        .brand { font-size: 24px; font-weight: bold; color: #4f46e5; }
        .muted { color: #6b7280; }
        .meta { text-align: right; }
        .meta h1 { font-size: 20px; margin: 0 0 6px; color: #111827; letter-spacing: 1px; }
        .section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #6b7280; margin-bottom: 6px; }
        table.items { width: 100%; border-collapse: collapse; margin-top: 24px; }
        table.items th { background: #eef2ff; color: #3730a3; text-align: left; padding: 10px; font-size: 11px; text-transform: uppercase; }
        table.items td { padding: 10px; border-bottom: 1px solid #e5e7eb; }
        table.items td.right, table.items th.right { text-align: right; }
        .totals { width: 45%; float: right; margin-top: 16px; }
        .totals table { width: 100%; border-collapse: collapse; }
        .totals td { padding: 8px 10px; }
        .totals .grand { background: #4f46e5; color: #fff; font-weight: bold; font-size: 14px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 10px; text-transform: uppercase; }
        .badge-paid { background: #dcfce7; color: #166534; }
        .badge-pending { background: #fef9c3; color: #854d0e; }
        .footer { clear: both; margin-top: 120px; border-top: 1px solid #e5e7eb; padding-top: 12px; font-size: 10px; color: #9ca3af; text-align: center; }
        .clearfix::after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>
<div class="wrap">
    <table class="header">
        <tr>
            <td>
                <div class="brand">{{ setting('site_name', config('app.name')) }}</div>
                <div class="muted">
                    {!! nl2br(e(setting('company_address', ''))) !!}<br>
                    {{ setting('company_phone', '') }}<br>
                    {{ setting('company_email', '') }}
                </div>
            </td>
            <td class="meta">
                <h1>INVOICE</h1>
                <div><strong>{{ $invoice->invoice_number }}</strong></div>
                <div class="muted">Order: {{ $order->order_number }}</div>
                <div class="muted">Date: {{ ($invoice->created_at ?? now())->format('M d, Y') }}</div>
                <div style="margin-top:8px;">
                    <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-pending' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <table style="width:100%;">
        <tr>
            <td style="width:50%;">
                <div class="section-title">Billed To</div>
                <strong>{{ $order->user->name }}</strong><br>
                <span class="muted">{{ $order->user->email }}</span><br>
                <span class="muted">{{ $order->user->phone }}</span>
            </td>
            <td style="width:50%;" class="meta">
                <div class="section-title">Payment Method</div>
                <strong>{{ $order->payment_method === 'online_gateway' ? 'Online Payment Gateway' : 'Bank Transfer (Offline)' }}</strong><br>
                <span class="muted">Placed: {{ $order->created_at->format('M d, Y H:i') }}</span>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
        <tr>
            <th>Description</th>
            <th>Billing Cycle</th>
            <th class="right">Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->billing_cycle ? ucfirst($item->billing_cycle) : '—' }}</td>
                <td class="right">{{ money($item->price, setting('currency_symbol', 'Rs.')) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="clearfix">
        <div class="totals">
            <table>
                <tr>
                    <td class="muted">Subtotal</td>
                    <td class="right">{{ money($order->total_amount, setting('currency_symbol', 'Rs.')) }}</td>
                </tr>
                <tr>
                    <td class="muted">Tax</td>
                    <td class="right">{{ money(0, setting('currency_symbol', 'Rs.')) }}</td>
                </tr>
                <tr class="grand">
                    <td>Total Paid</td>
                    <td class="right">{{ money($order->total_amount, setting('currency_symbol', 'Rs.')) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        Thank you for your business. This is a computer generated invoice.<br>
        {{ setting('site_name', config('app.name')) }} &middot; {{ setting('company_email', '') }}
    </div>
</div>
</body>
</html>
