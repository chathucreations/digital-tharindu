<?php

namespace App\Services;

class CartService
{
    protected const KEY = 'cart';

    /**
     * @return array<string, array{product_id:int, variation_id:?int, name:string, billing_cycle:?string, price:float, image:?string}>
     */
    public function items(): array
    {
        return session()->get(self::KEY, []);
    }

    /**
     * Add (or replace) an item in the cart. A cart line is uniquely
     * identified by its product + variation combination.
     *
     * @param  array{product_id:int, variation_id:?int, name:string, billing_cycle:?string, price:float, image:?string}  $line
     */
    public function add(array $line): string
    {
        $key = $this->keyFor($line['product_id'], $line['variation_id'] ?? null);
        $items = $this->items();
        $items[$key] = $line;
        session()->put(self::KEY, $items);

        return $key;
    }

    public function remove(?string $key): void
    {
        $items = $this->items();
        unset($items[$key]);
        session()->put(self::KEY, $items);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function count(): int
    {
        return count($this->items());
    }

    public function subtotal(): float
    {
        return array_sum(array_map(
            static fn (array $item): float => (float) $item['price'],
            $this->items(),
        ));
    }

    public function has(int $productId): bool
    {
        foreach ($this->items() as $item) {
            if ((int) $item['product_id'] === $productId) {
                return true;
            }
        }

        return false;
    }

    public function keyFor(int $productId, ?int $variationId = null): string
    {
        return $productId . ':' . ($variationId ?? 0);
    }
}
