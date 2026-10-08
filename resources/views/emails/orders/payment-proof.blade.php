<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body style="font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <h2 style="color:#4f46e5;">Payment Proof Submitted</h2>
    <p>A customer has submitted a bank-transfer payment proof. Please verify and mark the order as paid.</p>

    <table style="border-collapse:collapse;font-size:14px;">
        <tr><td style="padding:4px 12px 4px 0;color:#6b7280;">Order</td><td><strong>{{ $order->order_number }}</strong></td></tr>
        <tr><td style="padding:4px 12px 4px 0;color:#6b7280;">Amount</td><td><strong>{{ money($order->total_amount) }}</strong></td></tr>
        <tr><td style="padding:4px 12px 4px 0;color:#6b7280;">Customer</td><td>{{ $order->user->name }} ({{ $order->user->email }})</td></tr>
        <tr><td style="padding:4px 12px 4px 0;color:#6b7280;">Phone</td><td>{{ $order->user->phone ?: '—' }}</td></tr>
    </table>

    @if ($order->offline_note)
        <p style="margin-top:16px;"><strong>Customer note:</strong><br><span style="white-space:pre-line;">{{ $order->offline_note }}</span></p>
    @endif

    <p style="margin-top:20px;">
        <a href="{{ url('/digitalsup/orders/' . $order->id) }}" style="color:#4f46e5;">Open order in the admin panel &rarr;</a>
    </p>
</body>
</html>
