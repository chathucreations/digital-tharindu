<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Rules\SriLankanPhone;
use App\Services\CartService;
use App\Services\MarxIpgService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cart,
        protected OrderService $orders,
    ) {}

    public function index(): View|RedirectResponse
    {
        if (empty($this->cart->items())) {
            return redirect()->route('products.index')->with('status', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'items' => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
            'onlineEnabled' => app(MarxIpgService::class)->enabled(),
        ]);
    }

    public function store(Request $request, MarxIpgService $marx): RedirectResponse
    {
        if (empty($this->cart->items())) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }

        $data = $request->validate([
            'payment_method' => ['required', 'in:online_gateway,offline'],
            'phone' => ['required', 'string', new SriLankanPhone()],
            'terms' => ['accepted'],
        ]);

        $request->user()->update(['phone' => $data['phone']]);

        if ($data['payment_method'] === 'online_gateway' && ! $marx->enabled()) {
            throw ValidationException::withMessages([
                'payment_method' => 'Online payment is currently unavailable. Please choose bank transfer.',
            ]);
        }

        $order = $this->orders->createFromCart($request->user(), $data['payment_method']);

        $this->cart->clear();

        if ($data['payment_method'] === 'offline') {
            return redirect()
                ->route('customer.orders.show', $order)
                ->with('status', 'Order placed! Please upload your bank transfer receipt below to confirm your payment.');
        }

        $result = $marx->createOrder($order);

        if (! empty($result['payUrl'])) {
            $order->update([
                'gateway_reference' => $result['trId'],
                'gateway_response' => $result['raw'],
            ]);

            return redirect()->away($result['payUrl']);
        }

        return redirect()
            ->route('customer.orders.show', $order)
            ->with('error', 'We could not reach the payment gateway. Your order was saved as pending — please contact us to complete payment.');
    }

    public function success(Order $order): View
    {
        $this->authorizeOrder($order);

        $order->load(['items.product', 'invoice']);

        return view('checkout.success', compact('order'));
    }

    protected function authorizeOrder(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
