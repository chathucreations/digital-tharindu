<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index(): View
    {
        return view('cart.index', [
            'items' => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = $this->addItem($request);

        return redirect()->route('cart.index')->with('status', $product->name . ' added to your cart.');
    }

    /**
     * Add the item and go straight to checkout (skip the cart page).
     */
    public function buyNow(Request $request): RedirectResponse
    {
        $this->addItem($request);

        return redirect()->route('checkout.index');
    }

    public function destroy(Request $request, string $key): RedirectResponse
    {
        $this->cart->remove($key);

        return redirect()->route('cart.index')->with('status', 'Item removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();

        return redirect()->route('cart.index')->with('status', 'Cart cleared.');
    }

    /**
     * Validate the request and push the chosen product/variation onto the cart.
     */
    protected function addItem(Request $request): Product
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'variation_id' => ['nullable', 'exists:product_variations,id'],
        ]);

        $product = Product::query()->with('variations')->findOrFail($data['product_id']);

        abort_if($product->variations->isEmpty(), 422, 'This product has no pricing options.');

        $variation = $product->variations->firstWhere('id', (int) ($data['variation_id'] ?? 0))
            ?? $product->variations->first();

        $this->cart->add([
            'product_id' => $product->getKey(),
            'variation_id' => $variation?->getKey(),
            'name' => $product->name,
            'billing_cycle' => $variation?->billing_cycle,
            'price' => (float) $variation?->price,
            'image' => $product->image,
        ]);

        return $product;
    }
}
