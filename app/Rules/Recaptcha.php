<?php

namespace App\Rules;

use App\Support\Settings;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

/**
 * Verifies a Google reCAPTCHA token.
 *
 * The check is skipped entirely when reCAPTCHA is disabled or no secret key
 * is configured, so the app (and its tests) work without credentials.
 */
class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Settings::get('recaptcha_enabled')) {
            return;
        }

        $secret = Settings::get('recaptcha_secret_key');

        if (blank($secret)) {
            return;
        }

        if (blank($value)) {
            $fail('Please complete the reCAPTCHA verification.');

            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secret,
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ])
                ->json();

            if (! ($response['success'] ?? false)) {
                $fail('The reCAPTCHA verification failed. Please try again.');
            }
        } catch (\Throwable $e) {
            // Fail open only when Google is unreachable, to avoid locking
            // everyone out during a network outage.
            report($e);
        }
    }
}
