<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $this->rememberIntendedRedirect($request);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->homeUrlFor($request->user()));
    }

    /**
     * Where to send a user after login: admins to the Filament panel,
     * customers to their dashboard.
     */
    protected function homeUrlFor(?\App\Models\User $user): string
    {
        if ($user?->isAdmin()) {
            return route('filament.admin.pages.dashboard', absolute: false);
        }

        return route('customer.dashboard', absolute: false);
    }

    /**
     * Store a ?redirect= destination so the user returns to it after login
     * (e.g. back to the product they were buying). Only local paths allowed.
     */
    protected function rememberIntendedRedirect(Request $request): void
    {
        $redirect = (string) $request->query('redirect', '');

        if ($redirect !== '' && Str::startsWith($redirect, '/') && ! Str::startsWith($redirect, '//')) {
            session(['url.intended' => $redirect]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
