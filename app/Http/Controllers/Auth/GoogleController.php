<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth consent screen.
     */
    public function redirect(): RedirectResponse
    {
        if (blank(config('services.google.client_id')) || blank(config('services.google.client_secret'))) {
            return redirect()->route('login')->with(
                'error',
                'Google sign-in is not configured yet. Please sign in with your email and password, or contact support.',
            );
        }

        $this->applyRedirectUri();

        // Remember where to send the customer back to after signing in.
        if (request()->filled('redirect') && $this->isSafeRedirect(request('redirect'))) {
            session(['url.intended' => request('redirect')]);
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google (works as both sign-up and sign-in).
     */
    public function callback(): RedirectResponse
    {
        if (blank(config('services.google.client_id')) || blank(config('services.google.client_secret'))) {
            return redirect()->route('login')->with('error', 'Google sign-in is not configured yet.');
        }

        $this->applyRedirectUri();

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            report($e);

            return redirect()->route('login')->with('error', 'Unable to sign in with Google. Please try again.');
        }

        $email = strtolower(trim((string) $googleUser->getEmail()));

        if (blank($email)) {
            return redirect()->route('login')->with(
                'error',
                'We could not read your email address from Google. Please sign in with email and password instead.',
            );
        }

        $user = User::query()
            ->where('google_id', $googleUser->getId())
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: Str::before($email, '@'),
                'email' => $email,
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'role' => 'customer',
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);

        $home = $user->isAdmin()
            ? route('filament.admin.pages.dashboard', absolute: false)
            : route('customer.dashboard', absolute: false);

        return redirect()->intended($home);
    }

    protected function isSafeRedirect(?string $url): bool
    {
        if (blank($url)) {
            return false;
        }

        // Allow only local paths, never external URLs.
        return Str::startsWith($url, '/') && ! Str::startsWith($url, '//');
    }

    /**
     * Build the OAuth callback URL from the current request host so the
     * redirect_uri always matches the domain the customer is actually on
     * (localhost, 127.0.0.1, a Laragon .test domain, etc.).
     */
    protected function applyRedirectUri(): void
    {
        config(['services.google.redirect' => url('/auth/google/callback')]);
    }
}
