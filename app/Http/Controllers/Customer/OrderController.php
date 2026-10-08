<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\PaymentProofMail;
use App\Models\Invoice;
use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()
            ->with('invoice')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $this->authorizeOrder($order);

        $order->load(['items.product', 'invoice']);

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Store the bank-transfer payment proof (receipt + note) for an offline order.
     */
    public function uploadProof(Request $request, Order $order): RedirectResponse
    {
        $this->authorizeOrder($order);

        abort_unless($order->payment_method === 'offline', 403);
        abort_if($order->payment_status === 'paid', 403);

        $data = $request->validate([
            'offline_receipt' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'offline_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $order->update([
            'offline_receipt' => $request->file('offline_receipt')->store('receipts', 'public'),
            'offline_note' => $data['offline_note'] ?? $order->offline_note,
        ]);

        activity('order')
            ->performedOn($order)
            ->causedBy($request->user())
            ->withProperties([
                'receipt' => $order->offline_receipt,
                'note' => $data['offline_note'] ?? null,
            ])
            ->log('Payment receipt uploaded');

        $recipient = setting('contact_email') ?: config('mail.from.address');

        if ($recipient) {
            try {
                Mail::to($recipient)->send(new PaymentProofMail($order->fresh(['user', 'items'])));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return back()->with('status', 'Payment proof submitted. We will verify your payment and activate your order shortly.');
    }

    public function invoice(Invoice $invoice)
    {
        abort_unless($invoice->order->user_id === auth()->id(), 403);

        $service = app(InvoiceService::class);

        return $service->download($service->generateForOrder($invoice->order));
    }

    protected function authorizeOrder(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
