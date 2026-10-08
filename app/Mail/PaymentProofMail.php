<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PaymentProofMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment proof submitted — order ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.payment-proof',
            with: ['order' => $this->order],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $path = $this->order->offline_receipt;

        if ($path && Storage::disk('public')->exists($path)) {
            $extension = pathinfo($path, PATHINFO_EXTENSION) ?: 'pdf';

            return [
                Attachment::fromStorageDisk('public', $path)
                    ->as('receipt-' . $this->order->order_number . '.' . $extension),
            ];
        }

        return [];
    }
}
