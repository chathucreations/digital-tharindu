<?php

use App\Support\Settings;

if (! function_exists('setting')) {
    /**
     * Get a site setting value.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Settings::get($key, $default);
    }
}

if (! function_exists('money')) {
    /**
     * Format a monetary amount using the configured currency symbol.
     */
    function money(float|int|string|null $amount, ?string $currency = null): string
    {
        $symbol = $currency ?? (string) Settings::get('currency_symbol', 'Rs.');

        return trim($symbol . ' ' . number_format((float) $amount, 2));
    }
}

if (! function_exists('media_url')) {
    /**
     * Resolve a stored media path to a public URL. Absolute URLs are
     * returned as-is, everything else is resolved from the public disk.
     */
    function media_url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    }
}
