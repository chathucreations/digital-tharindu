<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MarxIpgService;
use App\Services\OrderFulfillmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarxIpgController extends Controller
{
    /**
     * Handle the return from the Marx IPG (3DS) flow.
     */
    public function callback(Request $request, MarxIpgService $marx, OrderFulfillmentService $fulfillment): RedirectResponse
    {
        $trId = (string) ($request->query('tr_id') ?? $request->query('trId') ?? '');
        $merchantRid = (string) ($request->query('merchantRID') ?? $request->query('merchantRid') ?? '');

        $order = Order::query()->where('order_number', $merchantRid)->first();

        abort_if(! $order, 404);

        $result = $marx->initiate($trId, $merchantRid);

        if ($result['success']) {
            $fulfillment->complete(
                $order,
                array_merge((array) ($result['raw'] ?? []), ['tr_id' => $trId]),
                $trId ?: $order->gateway_reference,
            );

            return redirect()->route('checkout.success', $order)
                ->with('status', 'Payment successful! Your digital products are ready.');
        }

        $order->update(['payment_status' => 'failed']);

        activity('order')->performedOn($order)->causedBy($order->user)->log('Payment failed');

        return redirect()->route('checkout.success', $order)
            ->with('error', 'Payment was not completed. Your order is still pending.');
    }

    /**
     * Built-in sandbox gateway page (used when no live credentials exist).
     */
    public function sandbox(Order $order): View
    {
        $this->authorizeOwner($order);

        abort_unless($order->payment_method === 'online_gateway', 404);

        return view('checkout.sandbox', compact('order'));
    }

    public function sandboxComplete(Order $order, OrderFulfillmentService $fulfillment): RedirectResponse
    {
        $this->authorizeOwner($order);

        $fulfillment->complete(
            $order,
            ['sandbox' => true, 'result' => 'success'],
            'SANDBOX-' . $order->order_number,
        );

        return redirect()->route('checkout.success', $order)
            ->with('status', 'Sandbox payment successful! Your digital products are ready.');
    }

    public function sandboxCancel(Order $order): RedirectResponse
    {
        $this->authorizeOwner($order);

        $order->update(['payment_status' => 'failed']);

        activity('order')->performedOn($order)->causedBy($order->user)->log('Sandbox payment cancelled');

        return redirect()->route('checkout.success', $order)
            ->with('error', 'Sandbox payment was cancelled. Your order is still pending.');
    }

    protected function authorizeOwner(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
