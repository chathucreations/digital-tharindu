<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Order;
use App\Support\Settings;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    /**
     * Generate (or return the existing) PDF invoice for an order.
     */
    public function generateForOrder(Order $order): Invoice
    {
        $order->loadMissing(['items.product', 'user', 'invoice']);

        $invoice = $order->invoice ?? new Invoice(['order_id' => $order->id]);

        if (blank($invoice->invoice_number)) {
            $invoice->invoice_number = $this->nextInvoiceNumber();
        }

        if ($invoice->exists && filled($invoice->pdf_path) && Storage::disk('public')->exists($invoice->pdf_path)) {
            return $invoice;
        }

        $pdf = Pdf::loadView('invoices.pdf', [
            'order' => $order,
            'invoice' => $invoice,
        ])->setPaper('a4');

        $path = 'invoices/' . $invoice->invoice_number . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        $invoice->pdf_path = $path;
        $invoice->order_id = $order->id;
        $invoice->save();

        return $invoice;
    }

    /**
     * Stream the invoice PDF to the browser.
     */
    public function download(Invoice $invoice)
    {
        if (filled($invoice->pdf_path) && Storage::disk('public')->exists($invoice->pdf_path)) {
            return response()->download(
                Storage::disk('public')->path($invoice->pdf_path),
                $invoice->invoice_number . '.pdf',
                ['Content-Type' => 'application/pdf'],
            );
        }

        $invoice = $this->generateForOrder($invoice->order);

        return response()->download(
            Storage::disk('public')->path($invoice->pdf_path),
            $invoice->invoice_number . '.pdf',
            ['Content-Type' => 'application/pdf'],
        );
    }

    protected function nextInvoiceNumber(): string
    {
        $prefix = Settings::get('invoice_prefix', 'INV') ?: 'INV';
        $sequence = Invoice::query()->count() + 1;

        do {
            $number = sprintf('%s-%s-%05d', $prefix, date('Y'), $sequence);
            $sequence++;
        } while (Invoice::query()->where('invoice_number', $number)->exists());

        return $number;
    }
}
