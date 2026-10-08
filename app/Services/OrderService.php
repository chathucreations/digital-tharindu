<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class OrderService
{
    public function __construct(protected CartService $cart) {}

    /**
     * Create a pending order from the current session cart.
     *
     * @param  array<string, mixed>  $extra
     */
    public function createFromCart(User $user, string $paymentMethod, array $extra = []): Order
    {
        $items = $this->cart->items();

        if (empty($items)) {
            throw new RuntimeException('Your cart is empty.');
        }

        return DB::transaction(function () use ($user, $paymentMethod, $items, $extra): Order {
            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'user_id' => $user->id,
                'total_amount' => $this->cart->subtotal(),
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'offline_receipt' => $extra['offline_receipt'] ?? null,
                'offline_note' => $extra['offline_note'] ?? null,
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'variation_id' => $item['variation_id'] ?? null,
                    'product_name' => $item['name'],
                    'billing_cycle' => $item['billing_cycle'] ?? null,
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });
    }

    public function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Order::query()->where('order_number', $number)->exists());

        return $number;
    }
}
