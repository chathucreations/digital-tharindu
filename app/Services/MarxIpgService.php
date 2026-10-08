<?php

namespace App\Services;

use App\Models\Order;
use App\Support\Settings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Marx Internet Payment Gateway (IPG) integration — API v2.
 *
 * @see https://marx.lk/wp-content/uploads/2022/06/Marx-IPG-Integration-Documentation-v2.0.0.pdf
 *
 * Flow:
 *   1. POST {endpoint}          -> create order, receive `payUrl` + `trId`
 *   2. Redirect the customer to `payUrl`
 *   3. Gateway returns to our `returnUrl?tr_id=...&merchantRID=...`
 *   4. PUT  {endpoint}/{tr_id}  -> initiate / verify the payment
 *
 * Credentials are managed from Admin → Site Settings → Payment Gateway,
 * falling back to the values in config/services.php (environment).
 * When no merchant secret is configured (or mode is "sandbox"), a built-in
 * sandbox simulation page is used so the checkout flow stays testable.
 */
class MarxIpgService
{
    public function enabled(): bool
    {
        $value = Settings::get('marx_enabled');

        if ($value === null) {
            return (bool) config('services.marx.enabled', true);
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function mode(): string
    {
        return (string) Settings::get('marx_mode', config('services.marx.mode', 'sandbox'));
    }

    public function merchantId(): ?string
    {
        return Settings::get('marx_merchant_id', config('services.marx.merchant_id'));
    }

    public function apiKey(): ?string
    {
        return Settings::get('marx_api_key', config('services.marx.api_key'));
    }

    public function secret(): ?string
    {
        return Settings::get('marx_secret', config('services.marx.secret'));
    }

    public function endpoint(): string
    {
        return (string) Settings::get(
            'marx_endpoint',
            config('services.marx.endpoint', 'https://dev.app.marx.lk/api/v2/ipg/orders'),
        );
    }

    public function currency(): string
    {
        return (string) Settings::get('marx_currency', config('services.marx.currency', 'LKR'));
    }

    public function validTimeLimit(): int
    {
        return (int) Settings::get('marx_valid_time_limit', config('services.marx.valid_time_limit', 5));
    }

    /**
     * Whether real gateway credentials are configured.
     */
    public function configured(): bool
    {
        if ($this->mode() === 'sandbox' && blank($this->secret())) {
            return false;
        }

        return filled($this->secret());
    }

    /**
     * Create the order on the gateway and return the payment URL.
     *
     * @return array{sandbox:bool, success:bool, payUrl:?string, trId:?string, raw:array}
     */
    public function createOrder(Order $order): array
    {
        $order->loadMissing('user');

        $payload = [
            'merchantRID' => $order->order_number,
            'amount' => (float) $order->total_amount,
            'validTimeLimit' => $this->validTimeLimit(),
            'returnUrl' => route('checkout.marx.callback'),
            'customerMail' => $order->user->email,
            'customerMobile' => $order->user->phone,
            'mode' => 'WEB',
            'orderSummary' => 'Digital Store order ' . $order->order_number,
            'customerReference' => $order->user_id . '-' . Str::uuid(),
        ];

        if (! $this->configured()) {
            return [
                'sandbox' => true,
                'success' => true,
                'payUrl' => route('checkout.marx.sandbox', $order),
                'trId' => 'SANDBOX-' . $order->order_number,
                'raw' => $payload,
            ];
        }

        try {
            $response = Http::withHeaders(['key' => $this->secret()])
                ->acceptJson()
                ->post($this->endpoint(), $payload);

            $data = $response->json() ?? [];
            $payUrl = data_get($data, 'data.payUrl') ?? data_get($data, 'data.paymentUrl');
            $trId = data_get($data, 'data.trId') ?? data_get($data, 'data.tr_id');

            return [
                'sandbox' => false,
                'success' => $response->successful() && filled($payUrl),
                'payUrl' => $payUrl,
                'trId' => $trId !== null ? (string) $trId : null,
                'raw' => $data,
            ];
        } catch (\Throwable $e) {
            report($e);

            return [
                'sandbox' => false,
                'success' => false,
                'payUrl' => null,
                'trId' => null,
                'raw' => ['error' => $e->getMessage()],
            ];
        }
    }

    /**
     * Initiate / verify the payment after the customer returns from 3DS.
     *
     * @return array{sandbox:bool, success:bool, raw:array}
     */
    public function initiate(string $trId, string $merchantRID): array
    {
        if (! $this->configured()) {
            return ['sandbox' => true, 'success' => true, 'raw' => []];
        }

        try {
            $endpoint = rtrim($this->endpoint(), '/') . '/' . $trId;

            $response = Http::withHeaders(['key' => $this->secret()])
                ->acceptJson()
                ->put($endpoint, ['merchantRID' => $merchantRID]);

            return [
                'sandbox' => false,
                'success' => $response->successful(),
                'raw' => $response->json() ?? [],
            ];
        } catch (\Throwable $e) {
            report($e);

            return ['sandbox' => false, 'success' => false, 'raw' => ['error' => $e->getMessage()]];
        }
    }
}
