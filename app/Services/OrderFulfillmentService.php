<?php

namespace App\Services;

use App\Mail\OrderCompletedMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderFulfillmentService
{
    public function __construct(protected InvoiceService $invoices) {}

    /**
     * Mark an order as paid, generate its invoice and email the customer
     * their invoice plus digital access details.
     */
    public function complete(Order $order, array $gatewayResponse = [], ?string $reference = null): void
    {
        if ($order->isCompleted() && $order->invoice) {
            return;
        }

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'completed',
            'paid_at' => now(),
            'gateway_reference' => $reference ?: $order->gateway_reference,
            'gateway_response' => ! empty($gatewayResponse) ? $gatewayResponse : $order->gateway_response,
        ]);

        $order = $order->fresh(['items.product', 'user']);
        $this->invoices->generateForOrder($order);

        activity('order')
            ->performedOn($order)
            ->causedBy($order->user)
            ->withProperties([
                'reference' => $reference,
                'total' => (float) $order->total_amount,
                'payment_method' => $order->payment_method,
            ])
            ->log('Payment received — order completed');

        $this->sendCompletionEmail($order->fresh(['items.product', 'user', 'invoice']));
    }

    public function sendCompletionEmail(Order $order): void
    {
        try {
            if ($order->user?->email) {
                Mail::to($order->user->email)->send(new OrderCompletedMail($order));
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
