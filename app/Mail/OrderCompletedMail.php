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

class OrderCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order ' . $this->order->order_number . ' confirmed — your digital products are ready',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.completed',
            with: [
                'order' => $this->order,
                'invoice' => $this->order->invoice,
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $invoice = $this->order->invoice;

        if ($invoice && filled($invoice->pdf_path) && Storage::disk('public')->exists($invoice->pdf_path)) {
            return [
                Attachment::fromStorageDisk('public', $invoice->pdf_path)
                    ->as($invoice->invoice_number . '.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
